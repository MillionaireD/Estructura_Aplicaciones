<?php
include("algoritmos.php");

// Array de ejemplo - podemos hacerlo más grande para ver mejor las diferencias
$numeros = $_GET['numeros'] ?? "15,8,3,12,7,1,20,5,18,9,4,11,6,19,2,14,10,17,13,16";
$numerosArray = array_map('intval', explode(',', $numeros));

// Algoritmo seleccionado
$algoritmo = $_GET['algoritmo'] ?? "merge";

$ordenado = [];
$tiempo = 0;
$iteraciones = 0; // Para mostrar estadísticas

$start = microtime(true);
switch ($algoritmo) {
    case "merge":
        $ordenado = mergeSort($numerosArray);
        $algoritmoNombre = "MergeSort";
        break;
    case "quick":
        $ordenado = quickSort($numerosArray);
        $algoritmoNombre = "QuickSort";
        break;
    case "bubble":
        $ordenado = bubbleSort($numerosArray);
        $algoritmoNombre = "BubbleSort";
        break;
    default:
        $ordenado = $numerosArray;
        $algoritmoNombre = "Ninguno";
        break;
}
$tiempo = microtime(true) - $start;

include("../includes/header.php");
?>

<h2>Comparación de Algoritmos de Ordenamiento</h2>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Configuración</h5>
            </div>
            <div class="card-body">
                <form method="get" class="mb-3">
                    <div class="mb-3">
                        <label class="form-label">Array a ordenar (separado por comas):</label>
                        <input type="text" name="numeros" value="<?= htmlspecialchars($numeros) ?>" class="form-control">
                        <div class="form-text">Puedes usar arrays predefinidos o escribir el tuyo</div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Algoritmo:</label>
                        <select name="algoritmo" class="form-select">
                            <option value="merge" <?= $algoritmo=="merge"?"selected":"" ?>>MergeSort</option>
                            <option value="quick" <?= $algoritmo=="quick"?"selected":"" ?>>QuickSort</option>
                            <option value="bubble" <?= $algoritmo=="bubble"?"selected":"" ?>>BubbleSort</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Arrays predefinidos:</label>
                        <div>
                            <a href="?numeros=5,2,9,1,6,3,8&algoritmo=<?= $algoritmo ?>" class="btn btn-sm btn-outline-secondary me-1">Pequeño (7)</a>
                            <a href="?numeros=15,8,3,12,7,1,20,5,18,9,4,11,6,19,2,14,10,17,13,16&algoritmo=<?= $algoritmo ?>" class="btn btn-sm btn-outline-primary me-1">Mediano (20)</a>
                            <a href="?numeros=<?= implode(',', range(1, 50)) ?>&algoritmo=<?= $algoritmo ?>" class="btn btn-sm btn-outline-warning me-1">Grande (50)</a>
                            <a href="?numeros=<?= implode(',', array_reverse(range(1, 30))) ?>&algoritmo=<?= $algoritmo ?>" class="btn btn-sm btn-outline-danger">Invertido (30)</a>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Ordenar</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Resultados</h5>
            </div>
            <div class="card-body">
                <h4>Resultado con <?= $algoritmoNombre ?>:</h4>
                
                <div class="alert alert-info">
                    <strong>Tiempo de ejecución:</strong> <?= round($tiempo * 1000, 6) ?> ms<br>
                    <strong>Elementos ordenados:</strong> <?= count($ordenado) ?><br>
                    <strong>Array original:</strong> [<?= implode(', ', $numerosArray) ?>]
                </div>
                
                <?php if (count($ordenado) > 0): ?>
                    <div class="mb-2">
                        <strong>Array ordenado:</strong> [<?= implode(', ', $ordenado) ?>]
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Tabla detallada -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Detalle del Ordenamiento</h5>
    </div>
    <div class="card-body">
        <table id="tablaSort" class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Índice</th>
                    <th>Valor Original</th>
                    <th>Valor Ordenado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($ordenado as $i => $v): ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $numerosArray[$i] ?? '-' ?></td>
                        <td><strong><?= $v ?></strong></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Información sobre algoritmos -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Información de Algoritmos</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h6>MergeSort</h6>
                        <small><strong>Complejidad:</strong> O(n log n)</small><br>
                        <small><strong>Estable:</strong> Sí</small><br>
                        <small><strong>Memoria:</strong> O(n)</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h6>QuickSort</h6>
                        <small><strong>Complejidad:</strong> O(n log n) promedio</small><br>
                        <small><strong>Estable:</strong> No</small><br>
                        <small><strong>Memoria:</strong> O(log n)</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h6>BubbleSort</h6>
                        <small><strong>Complejidad:</strong> O(n²)</small><br>
                        <small><strong>Estable:</strong> Sí</small><br>
                        <small><strong>Memoria:</strong> O(1)</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    new DataTable('#tablaSort', {
        ordering: false, // Deshabilitar ordenamiento para no interferir
        searching: false,
        paging: <?= count($ordenado) > 10 ? 'true' : 'false' ?>,
        pageLength: 10
    });
});
</script>

<?php include("../includes/footer.php"); ?>