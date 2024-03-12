<?php
namespace app\models;

use yii\db\ActiveRecord;

class AppActiveRecord extends ActiveRecord {
  public $errorMessage;

  public function getModelErrors(): array {
    $errorList = [];
    foreach ($this->getErrors() as $attribute => $errors) {
      foreach ($errors as $error) {
        $errorList[] = "{$attribute}: {$error}";
      }
    }
    return $errorList;
  }
}