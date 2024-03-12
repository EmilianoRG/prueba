<?php
namespace app\models;

use Ramsey\Uuid\Uuid;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model {
  /** @var UploadedFile */
  public $imageFile;
  public $filename;

  public function rules(): array {
    return [
      [
        ['imageFile'],
        'file',
        'skipOnEmpty' => false,
        'extensions' => 'jpg, png, jpeg, gif',
        'maxFiles' => 1, // opcional
//        'maxSize' => 2097152 // opcional, 2097152 = 2MB (1024 * 1024 * 2)
      ],
    ];
  }

  public function upload(): bool {
    if ($this->validate()) {
      // AJUSTAR NOMBRE DEL ARCHIVO
//      $this->filename = $this->imageFile->baseName . '.' . $this->imageFile->extension;
      $this->filename = Uuid::uuid4()->toString() . '.' . $this->imageFile->extension;

      // CREAR DIRECTORIO (si no existe)
      $folder = Yii::getAlias('@app/web/archivos');
      if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
      }

      // ALMACENAR ARCHIVO
      $this->imageFile->saveAs('archivos/' . $this->filename);
      return true;

      // EXTRA: PARA BORRAR UN ARCHIVO PREVIO
//      unlink(Yii::getAlias('@app/web/archivos/foto.jpg'));
    }
    return false;
  }
}