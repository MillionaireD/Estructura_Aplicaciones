<?php
// Incluir header (con HTML, Bootstrap y sidebar)
include("includes/header.php");
?>

<?php
// -----------------------------
// Algoritmos de búsqueda
// -----------------------------

function busquedaSecuencial($lista, $objetivo) {
    foreach ($lista as $i => $valor) {
        if ($valor === $objetivo) {
            return $i;
        }
    }
    return -1;
}

function busquedaBinaria($lista, $objetivo) {
    $izq = 0;
    $der = count($lista) - 1;
    while ($izq <= $der) {
        $medio = intval(($izq + $der) / 2);
        if ($lista[$medio] == $objetivo) {
            return $medio;
        } elseif ($lista[$medio] < $objetivo) {
            $izq = $medio + 1;
        } else {
            $der = $medio - 1;
        }
    }
    return -1;
}

// -----------------------------
// Pruebas con distintos tamaños
// -----------------------------
$tamanos = [10, 100, 1000, 10000, 100000];
$resultados = [];

foreach ($tamanos as $n) {
    $lista = range(0, $n - 1);
    $objetivo = $lista[array_rand($lista)];

    // Búsqueda Secuencial
    $inicio = microtime(true);
    busquedaSecuencial($lista, $objetivo);
    $fin = microtime(true);
    $tiempoSecuencial = $fin - $inicio;

    // Búsqueda Binaria
    $inicio = microtime(true);
    busquedaBinaria($lista, $objetivo);
    $fin = microtime(true);
    $tiempoBinaria = $fin - $inicio;

    $resultados[] = [
        'n' => $n,
        'secuencial' => $tiempoSecuencial,
        'binaria' => $tiempoBinaria
    ];
}
?>

<div class="container mt-4">
    <h2 class="mb-4">Comparación de Búsqueda Secuencial vs Binaria</h2>

    <!-- Tabla de resultados -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Tamaño</th>
                    <th>Secuencial (seg)</th>
                    <th>Binaria (seg)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $r): ?>
                <tr>
                    <td><?= $r['n'] ?></td>
                    <td><?= number_format($r['secuencial'], 8) ?></td>
                    <td><?= number_format($r['binaria'], 8) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Gráfica -->
    <div class="mt-5">
        <canvas id="grafica" width="800" height="400"></canvas>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('grafica').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode(array_column($resultados, 'n')) ?>,
            datasets: [
                {
                    label: 'Secuencial',
                    data: <?= json_encode(array_column($resultados, 'secuencial')) ?>,
                    borderColor: 'red',
                    tension: 0.3,
                    fill: false
                },
                {
                    label: 'Binaria',
                    data: <?= json_encode(array_column($resultados, 'binaria')) ?>,
                    borderColor: 'blue',
                    tension: 0.3,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Comparación Secuencial vs Binaria'
                },
                legend: {
                    position: 'bottom'
                }
            },
            scales: {
                x: { title: { display: true, text: 'Tamaño del arreglo' } },
                y: { title: { display: true, text: 'Tiempo (segundos)' }, beginAtZero: true }
            }
        }
    });
</script>

<?php
// Incluir footer (cierra body y html)
include("includes/footer.php");
?>
