<h1>Hola Mundo</h1>
<div class="alert alert-primary" role="alert">
  Hola <strong><?= $nombreCompleto ?></strong>
</div>

<ul class="list-group" style="margin-bottom: 16px;">
  <?php foreach ($paises as $pais): ?>
  <li class="list-group-item"><?= $pais['nombre'] ?></li>
  <?php endforeach; ?>
</ul>

<div style="display: grid; grid-template-columns: repeat(5, 1fr); grid-gap: 16px;">
  <?php
  foreach ($paises as $pais) {
    echo '<img src="' . $pais['foto'] . '" alt="foto" class="img-fluid">';
  }
  ?>
</div>