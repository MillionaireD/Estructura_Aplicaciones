<?php
include("algoritmos.php");

// Array de ejemplo
$numeros = $_GET['numeros'] ?? "5,2,9,1,6,3,8";
$numerosArray = array_map('intval', explode(',', $numeros));

// Algoritmo seleccionado
$algoritmo = $_GET['algoritmo'] ?? "merge";

$ordenado = [];
$tiempo = 0;

$start = microtime(true);
switch ($algoritmo) {
    case "merge":
        $ordenado = mergeSort($numerosArray);
        break;
    case "quick":
        $ordenado = quickSort($numerosArray);
        break;
    case "bubble":
        $ordenado = bubbleSort($numerosArray);
        break;
}
$tiempo = microtime(true) - $start;

include("../includes/header.php");

?>

<h2>Comparación de Algoritmos</h2>

<p>Array a ordenar (separado por comas):</p>
<form method="get" class="mb-3">
    <input type="text" name="numeros" value="<?= htmlspecialchars($numeros) ?>" class="form-control w-50 d-inline">
    <select name="algoritmo" class="form-select w-auto d-inline">
        <option value="merge" <?= $algoritmo=="merge"?"selected":"" ?>>MergeSort</option>
        <option value="quick" <?= $algoritmo=="quick"?"selected":"" ?>>QuickSort</option>
        <option value="bubble" <?= $algoritmo=="bubble"?"selected":"" ?>>BubbleSort</option>
    </select>
    <button type="submit" class="btn btn-primary">Ordenar</button>
</form>

<h4>Resultado con <?= ucfirst($algoritmo) ?>:</h4>
<p>Tiempo de ejecución: <?= round($tiempo*1000, 4) ?> ms</p>

<table id="tablaSort" class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Índice</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($ordenado as $i => $v): ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $v ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
document.addEventListener("DOMContentLoaded", function() {
    new DataTable('#tablaSort');
});
</script>

<?php include("../includes/footer.php"); ?>
