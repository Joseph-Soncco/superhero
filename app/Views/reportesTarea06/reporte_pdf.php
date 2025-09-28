<?= $estilos ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<style>
  .page-header {
    text-align: center;
    font-size: 10px;
    color: #666;
  }

  .page-footer {
    text-align: center;
    font-size: 10px;
    color: #666;
  }
</style>

<page backtop="7mm" backbottom="7mm" backleft="7mm" backright="7mm">

  <page_header>
    <div class="page-header">
      Página [[page_cu]] de [[page_nb]]
    </div>
  </page_header>

  <page_footer>
    <div class="page-footer">
      <?= $titulo ?> - <?= date('d/m/Y') ?>
    </div>
  </page_footer>

  <!-- Encabezado del Reporte -->
  <div class="text-center mb-4">
    <h1 class="text-dark mb-3"><?= $titulo ?></h1>
    <hr class="w-25 mx-auto">
  </div>

  <!-- Información del Filtro -->
  <div class="card mb-3">
    <div class="card-header bg-light">
      <h5 class="card-title mb-0">Información del Filtro</h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-4">
          <strong>Género:</strong><br>
          <span class="text-muted"><?= $genderInfo ? $genderInfo['gender'] : 'Todos los géneros' ?></span>
        </div>
        <div class="col-md-4">
          <strong>Límite:</strong><br>
          <span class="text-muted"><?= $limit ?> registros</span>
        </div>
        <div class="col-md-4">
          <strong>Total:</strong><br>
          <span class="text-muted"><?= $total ?> superhéroes</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabla de Superhéroes -->
  <div class="table-responsive">
    <table class="table table-striped table-hover table-sm">
      <thead class="table-dark">
        <tr>
          <th class="text-center">ID</th>
          <th>Superhéroe</th>
          <th>Nombre Completo</th>
          <th>Género</th>
          <th>Raza</th>
          <th>Alineación</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($superheroes)): ?>
          <tr>
            <td colspan="6" class="text-center text-muted fst-italic py-3">
              No se encontraron superhéroes
            </td>
          </tr>
        <?php else: ?>
          <?php foreach ($superheroes as $hero): ?>
            <tr>
              <td class="text-center"><?= $hero['id'] ?></td>
              <td><?= $hero['superhero_name'] ?: 'N/A' ?></td>
              <td><?= $hero['full_name'] ?: 'N/A' ?></td>
              <td><?= $hero['gender'] ?: 'N/A' ?></td>
              <td><?= $hero['race'] ?: 'N/A' ?></td>
              <td><?= $hero['alignment'] ?: 'N/A' ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</page>