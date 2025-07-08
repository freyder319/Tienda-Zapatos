<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estadísticas de Ventas</title>
  <link rel="stylesheet" href="vista/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <script src="Vista/jquery/jquery.js"></script>
  <script src="Vista/js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>


<header>
        <h1>Tienda de Computadoras y Repuestos</h1>
        <div id="nav"></div>
</header>
<br><br>
<div class="container">
  <div class="row">
    <!-- Unidades por categoría -->
    <div class="col-md-6 mb-4">
      <h3 class="text-center">Unidades vendidas por categoría</h3>
      <canvas id="ventasCategoriaChart"></canvas>
    </div>
    <!-- Top 10 productos -->
    <div class="col-md-6 mb-4">
      <h3 class="text-center">Top 10 productos más vendidos</h3>
      <canvas id="productosVendidosChart"></canvas>
    </div>
  </div>

  <div class="row">
    <!-- Ingresos por categoría -->
    <div class="col-md-8 offset-md-2 mb-4">
      <h3 class="text-center">Ingresos por categoría (COP)</h3>
      <canvas id="ingresosCategoriaChart"></canvas>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // ---------------------- Datos PHP → JS ----------------------
  const labelsCat  = <?php echo json_encode($labelsCat); ?>;
  const dataCat    = <?php echo json_encode($dataCat, JSON_NUMERIC_CHECK); ?>;
  const labelsProd = <?php echo json_encode($labelsProd); ?>;
  const dataProd   = <?php echo json_encode($dataProd, JSON_NUMERIC_CHECK); ?>;
  const labelsIng  = <?php echo json_encode($labelsIng); ?>;
  const dataIng    = <?php echo json_encode($dataIng, JSON_NUMERIC_CHECK); ?>;

  // ------------------ Unidades por categoría (pie) ------------
  const ctxCat = document.getElementById('ventasCategoriaChart');
  new Chart(ctxCat, {
    type: 'pie',
    data: {
      labels: labelsCat,
      datasets: [{ data: dataCat }]
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'bottom' } }
    }
  });

  // ------------------ Top productos (bar) ---------------------
  const ctxProd = document.getElementById('productosVendidosChart');
  new Chart(ctxProd, {
    type: 'bar',
    data: {
      labels: labelsProd,
      datasets: [{
        label: 'Unidades vendidas',
        data: dataProd,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: { beginAtZero: true, ticks: { precision: 0 } }
      },
      plugins: { legend: { display: false } }
    }
  });

  // ------------------ Ingresos por categoría (bar) ------------
  const ctxIng = document.getElementById('ingresosCategoriaChart');
  new Chart(ctxIng, {
    type: 'bar',
    data: {
      labels: labelsIng,
      datasets: [{
        label: 'Ingresos (COP)',
        data: dataIng,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: value => new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP', maximumFractionDigits: 0 }).format(value)
          }
        }
      },
      plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: {
            label: ctx => new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP', maximumFractionDigits: 0 }).format(ctx.parsed.y)
          }
        }
      }
    }
  });
});
</script>

<footer class="text-center mt-4">
  <p>&copy; 2025 Tienda de Computadores y Repuestos. Todos los derechos reservados.</p>
</footer>
</body>
</html>