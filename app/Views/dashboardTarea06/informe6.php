<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Informe - 6</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</head>

<body>
  <div class="container">
    <h2 class="text-center mb-4">Promedio de Pesos por Editora</h2>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Gráfico de Pesos Promedio (kg)</h5>
            <button class="btn btn-outline-info" id="cambiar-orden">
              <i class="bi bi-arrow-up-down"></i> <span id="texto-orden">Menor a Mayor</span>
            </button>
          </div>
          <div class="card-body">
            <div style="height: 500px; position: relative;">
              <canvas id="lienzo"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Datos de Pesos Promedio</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead class="table-dark">
                  <tr>
                    <th>Editora</th>
                    <th>Peso Promedio (kg)</th>
                    <th>Total Superhéroes</th>
                  </tr>
                </thead>
                <tbody id="tabla-datos">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0/dist/chart.umd.min.js"></script>
  <script>
    const lienzo = document.getElementById("lienzo");
    const tablaDatos = document.getElementById("tabla-datos");
    const btnCambiarOrden = document.getElementById("cambiar-orden");
    const textoOrden = document.getElementById("texto-orden");

    let grafico = null;
    let datosPesos = [];
    let ordenAscendente = true;

    function renderGraphic() {
      grafico = new Chart(lienzo, {
        type: 'line',
        data: {
          labels: [],
          datasets: [{
            label: 'Peso Promedio (kg)',
            data: [],
            borderColor: 'rgba(255, 99, 132, 1)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: 'rgba(255, 99, 132, 1)',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 6,
            pointHoverRadius: 8
          }]
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
                text: 'Peso Promedio (kg)',
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
                },
                maxRotation: 45,
                minRotation: 45
              }
            }
          },
          plugins: {
            title: {
              display: true,
              text: 'Promedio de Pesos de Superhéroes por Editora',
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

    function cargarDatos() {
      fetch('<?= base_url() ?>/public/api/getdatainforme6cache', {
          method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            datosPesos = data.resumen;
            mostrarGrafico();
            mostrarTabla();
          }
        })
        .catch(error => {
          console.error(error);
        });
    }

    function cambiarOrden() {
      ordenAscendente = !ordenAscendente;
      textoOrden.textContent = ordenAscendente ? 'Menor a Mayor' : 'Mayor a Menor';
      mostrarGrafico();
      mostrarTabla();
    }

    function mostrarGrafico() {
      const datosOrdenados = [...datosPesos].sort((a, b) => {
        const pesoA = parseFloat(a.peso_promedio);
        const pesoB = parseFloat(b.peso_promedio);
        return ordenAscendente ? pesoA - pesoB : pesoB - pesoA;
      });

      const labels = datosOrdenados.map(row => row.publisher_name);
      const pesos = datosOrdenados.map(row => parseFloat(row.peso_promedio).toFixed(2));

      grafico.data.labels = labels;
      grafico.data.datasets[0].data = pesos;
      grafico.update();
    }

    function mostrarTabla() {
      tablaDatos.innerHTML = '';

      const datosOrdenados = [...datosPesos].sort((a, b) => {
        const pesoA = parseFloat(a.peso_promedio);
        const pesoB = parseFloat(b.peso_promedio);
        return ordenAscendente ? pesoA - pesoB : pesoB - pesoA;
      });

      datosOrdenados.forEach(row => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${row.publisher_name}</td>
          <td>${parseFloat(row.peso_promedio).toFixed(2)} kg</td>
          <td>${row.total_superheroes}</td>
        `;
        tablaDatos.appendChild(tr);
      });
    }

    btnCambiarOrden.addEventListener("click", cambiarOrden);

    renderGraphic();
    cargarDatos();
  </script>
</body>

</html>