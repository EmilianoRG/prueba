<?php
namespace app\commands;

use app\components\Util;
use app\models\auth\AuthAssignment;
use app\models\auth\AuthItem;
use app\models\auth\AuthItemChild;
use app\models\usuario\Usuario;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

class ConsoleController extends Controller {
  public function actionInit(): int {
    $transaction = Yii::$app->db->beginTransaction();
    try {
      // <editor-fold defaultstate="collapsed" desc="Usuario Default">

      $usuario = new Usuario();
      $usuario->nombre = 'Administrador';
      $usuario->usuario = 'admin@admin.com';
      $usuario->password = password_hash('12345678', PASSWORD_DEFAULT);
      $usuario->rol = Util::ROL_ADMINISTRADOR;
      if (!$usuario->save()) {
        $errorMessages = implode("\n", $usuario->getModelErrors());
        throw new \Exception("Ocurrió un problema al intentar crear el usuario por defecto\n{$errorMessages}");
      }
      
      // </editor-fold>

      // <editor-fold defaultstate="collapsed" desc="Roles">

      $rolAdministrador = new AuthItem();
      $rolAdministrador->name = Util::ROL_ADMINISTRADOR;
      $rolAdministrador->type = Util::TYPE_ROLE;
      $rolAdministrador->description = 'Acceso a toda la aplicación';
      if (!$rolAdministrador->save()) {
        $errorMessages = implode("\n", $rolAdministrador->getModelErrors());
        throw new \Exception("Ocurrió un problema al intentar crear el rol administrador\n{$errorMessages}");
      }

      $rolVentas = new AuthItem();
      $rolVentas->name = Util::ROL_VENTAS;
      $rolVentas->type = Util::TYPE_ROLE;
      $rolVentas->description = 'Acceso a las todas las órdenes';
      if (!$rolVentas->save()) {
        $errorMessages = implode("\n", $rolVentas->getModelErrors());
        throw new \Exception("Ocurrió un problema al intentar crear el rol ventas\n{$errorMessages}");
      }

      $rolCliente = new AuthItem();
      $rolCliente->name = Util::ROL_CLIENTE;
      $rolCliente->type = Util::TYPE_ROLE;
      $rolCliente->description = 'Acceso a órdenes propias';
      if (!$rolCliente->save()) {
        $errorMessages = implode("\n", $rolCliente->getModelErrors());
        throw new \Exception("Ocurrió un problema al intentar crear el rol cliente\n{$errorMessages}");
      }

      $authItemChild = new AuthItemChild();
      $authItemChild->parent = $rolAdministrador->name;
      $authItemChild->child = $rolVentas->name;
      if (!$authItemChild->save()) {
        $errorMessages = implode("\n", $authItemChild->getModelErrors());
        throw new \Exception("Ocurrió un problema al intentar jerarquizar el rol administrador y ventas\n{$errorMessages}");
      }

      $authAssignment = new AuthAssignment();
      $authAssignment->item_name = $rolAdministrador->name;
      $authAssignment->user_id = (string)$usuario->id;
      if (!$authAssignment->save()) {
        $errorMessages = implode("\n", $authAssignment->getModelErrors());
        throw new \Exception("Ocurrió un problema al intentar asignar el rol administrador al primer usuario\n{$errorMessages}");
      }

      // </editor-fold>

      $transaction->commit();
      echo 'Todo se generó correctamente :)';
      return ExitCode::OK;
    } catch (\Exception $ex) {
      $transaction->rollBack();
      echo "Ocurrió una excepción: {$ex->getMessage()}";
      return ExitCode::UNSPECIFIED_ERROR;
    }
  }
}
