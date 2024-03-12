<?php
namespace app\models;

use app\models\usuario\Usuario;
use Yii;
use yii\base\Model;

class LoginForm extends Model {
  public $email;
  public $password;
  public $rememberMe = true;

  /** @var ?Usuario */
  public $usuario;

  public function rules(): array {
    return [
      [['email', 'password'], 'required'],
      [['rememberMe'], 'boolean'],
      [['password'], 'validatePassword']
    ];
  }

  public function attributeLabels(): array {
    return [
      'email' => 'Usuario',
      'password' => 'Contraseña',
      'rememberMe' => '¿Recordar?'
    ];
  }

  public function validatePassword($attribute, $params) {
    if (!$this->hasErrors()) {
      $user = $this->getUser();
      if (!$user || !$user->validatePassword($this->password)) {
        $this->addError($attribute, 'Usuario o contraseña incorrectos');
      }
    }
  }

  public function login(): bool {
    if ($this->validate()) {
      return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
    }
    return false;
  }

  public function getUser(): ?Usuario {
    if (!$this->usuario) {
      $this->usuario = Usuario::find()->where(['usuario' => $this->email, 'status' => true])->one();
    }
    return $this->usuario;
  }
}
