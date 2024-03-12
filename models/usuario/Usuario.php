<?php
namespace app\models\usuario;

use app\components\Util;
use app\models\AppActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property int $id
 * @property string $nombre
 * @property string $usuario
 * @property string $password
 * @property string $rol
 * @property int $status
 */
class Usuario extends AppActiveRecord implements IdentityInterface {
  public $confirmarPassword;
  public $validarConfirmacionPassword = false; // validacion manual desde el controlador

  public static function tableName(): string {
    return 'usuarios';
  }

  public function rules(): array {
    return [
      [['nombre', 'usuario', 'rol'], 'required'], // se elimino password pero aun asi el obligatorio mas abajo
      [['status'], 'integer'],
      [['nombre', 'usuario', 'password', 'rol'], 'string', 'max' => 64],
      [['rol'], 'in', 'range' => array_keys(Util::$rolArray)],
      [['usuario'], 'email'],
      [['status'], 'boolean', 'trueValue' => true, 'falseValue' => false],
      [['password', 'confirmarPassword'], 'string', 'min' => 8, 'max' => 64],
      [['password'], 'required', 'on' => 'create'], // siempre es obligatorio pero mas que nada en el create (leer mas sobre "scenarios" para entender mejor la propiedad: "on")
      [
        ['confirmarPassword'],
        'validarConfirmarPassword',
        'when' => fn (Usuario $model) => $model->validarConfirmacionPassword
      ],
      [
        ['confirmarPassword'],
        'required',
        'when' => fn (Usuario $model) => $model->validarConfirmacionPassword
      ],
    ];
  }

  public function attributeLabels(): array {
    return [
      'id' => 'ID',
      'nombre' => 'Nombre',
      'usuario' => 'Usuario',
      'password' => 'Contraseña',
      'rol' => 'Rol',
      'status' => 'Status',
      'confirmarPassword' => 'Confirmar Contraseña'
    ];
  }

  public function validarConfirmarPassword($attribute, $params) {
    if ($this->password !== $this->confirmarPassword) {
      $message = 'Las contraseñas no coinciden';
      $this->addError('password', $message);
      $this->addError('confirmarPassword', $message);
    }
  }

  public static function findIdentity($id) {
    return static::findOne($id);
  }

  public static function findIdentityByAccessToken($token, $type = null) {
    return null;
  }

  public function getId() {
    return $this->id;
  }

  public function getAuthKey() {
    return null;
  }

  public function validateAuthKey($authKey): bool {
    return false;
  }

  public function validatePassword($password): bool {
    return password_verify($password, $this->password);
  }
}
