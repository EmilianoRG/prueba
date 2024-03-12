<?php
namespace app\components;

use app\models\usuario\Usuario;
use Yii;

class Util {
  const TYPE_ROLE = 1;
  const TYPE_PERMISSION = 2;

  const ROL_ADMINISTRADOR = 'ADMINISTRADOR';
  const ROL_VENTAS = 'VENTAS'; // por debajo de ADMINISTRADOR
  const ROL_CLIENTE = 'CLIENTE'; // no esta ligado con los anteriores, es independiente

  public static array $rolArray = [
    self::ROL_ADMINISTRADOR => 'ADMINISTRADOR',
    self::ROL_VENTAS => 'VENTAS',
    self::ROL_CLIENTE => 'CLIENTE'
  ];

  public static function getUsuario(): ?Usuario {
    if (Yii::$app->user->isGuest || !Yii::$app->user->id) {
      return null;
    }
    return Usuario::findOne(['id' => Yii::$app->user->id, 'status' => true]);
  }

  // esta funcion custom valida si el usuario tiene un rol especifico pero IGNORA LA JERARQUIA
  public static function hasRole(string $role, ?int $userId = null): bool {
    if (!$userId) {
      $userId = Yii::$app->user->id; // logged-in user
    }
    return in_array($role, array_keys(Yii::$app->authManager->getRolesByUser($userId)));
  }
}