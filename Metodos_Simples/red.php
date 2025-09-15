<?php
include("algoritmos.php");

$paquetes = [
    ["id"=>1, "tiempo"=>5, "prioridad"=>3],
    ["id"=>2, "tiempo"=>2, "prioridad"=>1],
    ["id"=>3, "tiempo"=>8, "prioridad"=>2],
    ["id"=>4, "tiempo"=>1, "prioridad"=>5],
];

// Criterio de ordenamiento desde GET
$criterio = $_GET['ordenar'] ?? "tiempo";

// Ordenamos usando usort
usort($paquetes, function($a, $b) use ($criterio) {
    return $a[$criterio] <=> $b[$criterio];
});

include("../includes/header.php");

?>

<h2>Simulador de Red</h2>
<p>Ordenar paquetes por:
    <a class="btn btn-sm btn-outline-primary" href="?ordenar=tiempo">Tiempo de llegada</a>
    <a class="btn btn-sm btn-outline-success" href="?ordenar=prioridad">Prioridad</a>
</p>

<table id="tablaPaquetes" class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tiempo</th>
            <th>Prioridad</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($paquetes as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p["id"]) ?></td>
                <td><?= htmlspecialchars($p["tiempo"]) ?></td>
                <td><?= htmlspecialchars($p["prioridad"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
document.addEventListener("DOMContentLoaded", function() {
    new DataTable('#tablaPaquetes');
});
</script>

<?php include("../includes/footer.php"); ?>
