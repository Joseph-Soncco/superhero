<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Informe - 5</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</head>

<body>
  <div class="container">
    <h2 class="text-center mb-4">Comparación de Editoras</h2>
    
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Seleccionar Editoras</h5>
          </div>
          <div class="card-body">
            <div id="editoras-list" class="mb-3" style="max-height: 300px; overflow-y: auto; border: 1px solid #dee2e6; padding: 10px; border-radius: 5px;">
            </div>
            <div class="d-grid gap-2 d-md-flex">
              <button class="btn btn-primary" id="actualizar-grafico">
                <i class="bi bi-graph-up"></i> Actualizar Gráfico
              </button>
              <button class="btn btn-outline-secondary" id="limpiar-seleccion">
                <i class="bi bi-x-circle"></i> Limpiar
              </button>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Gráfico de Comparación</h5>
          </div>
          <div class="card-body">
            <div style="height: 500px; position: relative;">
              <canvas id="lienzo"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0/dist/chart.umd.min.js"></script>
  <script>
    const lienzo = document.getElementById("lienzo");
    const btnActualizar = document.getElementById("actualizar-grafico");
    const btnLimpiar = document.getElementById("limpiar-seleccion");
    const editorasList = document.getElementById("editoras-list");

    let grafico = null;
    let datosEditoras = [];

    function renderGraphic() {
      grafico = new Chart(lienzo, {
        type: 'bar',
        data: {
          labels: [],
          datasets: [
            {
              label: 'Superhéroes',
              data: [],
              backgroundColor: [
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 99, 132, 0.8)',
                'rgba(255, 206, 86, 0.8)',
                'rgba(75, 192, 192, 0.8)',
                'rgba(153, 102, 255, 0.8)',
                'rgba(255, 159, 64, 0.8)',
                'rgba(199, 199, 199, 0.8)',
                'rgba(83, 102, 255, 0.8)',
                'rgba(255, 99, 255, 0.8)',
                'rgba(99, 255, 132, 0.8)'
              ],
              borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(199, 199, 199, 1)',
                'rgba(83, 102, 255, 1)',
                'rgba(255, 99, 255, 1)',
                'rgba(99, 255, 132, 1)'
              ],
              borderWidth: 2
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          aspectRatio: 1.5,
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Cantidad de Superhéroes',
                font: {
                  size: 14
                }
              },
              ticks: {
                font: {
                  size: 12
                }
              }
            },
            x: {
              title: {
                display: true,
                text: 'Editoras',
                font: {
                  size: 14
                }
              },
              ticks: {
                font: {
                  size: 12
                }
              }
            }
          },
          plugins: {
            title: {
              display: true,
              text: 'Comparación de Editoras por Número de Superhéroes',
              font: {
                size: 16
              }
            },
            legend: {
              labels: {
                font: {
                  size: 12
                }
              }
            }
          }
        }
      });
    }

    function cargarEditoras() {
      fetch('<?= base_url() ?>/public/api/getdatainforme5cache', { method: 'GET' })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            datosEditoras = data.resumen;
            mostrarEditoras();
          }
        })
        .catch(error => {
          console.error(error);
        });
    }

    function mostrarEditoras() {
      editorasList.innerHTML = '';
      datosEditoras.forEach((editora, index) => {
        const div = document.createElement('div');
        div.className = 'form-check mb-2';
        div.innerHTML = `
          <input class="form-check-input" type="checkbox" value="${editora.publisher_name}" id="editora_${index}">
          <label class="form-check-label" for="editora_${index}">
            ${editora.publisher_name} - ${editora.total} superhéroes
          </label>
        `;
        editorasList.appendChild(div);
      });
    }

    function limpiarSeleccion() {
      const checkboxes = document.querySelectorAll('#editoras-list input[type="checkbox"]');
      checkboxes.forEach(checkbox => {
        checkbox.checked = false;
      });
      
      grafico.data.labels = [];
      grafico.data.datasets[0].data = [];
      grafico.update();
    }

    btnActualizar.addEventListener("click", () => {
      const checkboxes = document.querySelectorAll('#editoras-list input[type="checkbox"]:checked');
      
      if (checkboxes.length === 0) {
        alert('Selecciona al menos una editora');
        return;
      }

      const editorasSeleccionadas = Array.from(checkboxes).map(cb => cb.value);
      const datosFiltrados = datosEditoras.filter(editora => 
        editorasSeleccionadas.includes(editora.publisher_name)
      );

      grafico.data.labels = datosFiltrados.map(row => row.publisher_name);
      grafico.data.datasets[0].data = datosFiltrados.map(row => row.total);
      grafico.update();
    });

    btnLimpiar.addEventListener("click", limpiarSeleccion);

    renderGraphic();
    cargarEditoras();

  </script>
</body>

</html>
