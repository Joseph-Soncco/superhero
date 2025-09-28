<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Reporte PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0 text-center">Generador de Reporte PDF</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url() . "reportes/gender-limit" ?>" method="post">
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título del Reporte:</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" value="Reporte SH 2025" required>
                            </div>

                            <div class="mb-3">
                                <label for="gender_id" class="form-label">Filtrar por Género:</label>
                                <select name="gender_id" id="gender_id" class="form-select">
                                    <option value="">Todos los géneros</option>
                                    <?php foreach ($genders as $gender): ?>
                                        <option value="<?= $gender['gender_id'] ?>">
                                            <?= $gender['gender'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="limit" class="form-label">Límite de Registros:</label>
                                <input type="number" class="form-control" id="limit" name="limit" value="50" min="10" max="200" required>
                                <div class="form-text">Mínimo: 10, Máximo: 200</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Resumen por Género:</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <?php foreach ($genderCounts as $count): ?>
                                        <span class="badge bg-secondary">
                                            <?= $count['gender'] ?>: <?= $count['total'] ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-outline-secondary me-md-2" onclick="resetForm()">Limpiar</button>
                                <button type="submit" class="btn btn-primary">Generar PDF</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function resetForm() {
            document.getElementById('titulo').value = 'Reporte SH 2025';
            document.getElementById('gender_id').value = '';
            document.getElementById('limit').value = '50';
        }

        document.querySelector('form').addEventListener('submit', function(e) {
            const limit = parseInt(document.getElementById('limit').value);
            if (limit < 10 || limit > 200) {
                e.preventDefault();
                alert('El límite debe estar entre 10 y 200 registros');
            }
        });
    </script>
</body>
</html>