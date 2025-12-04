<?php
include("algoritmos.php");

$paquetes = [
    ["id"=>1, "tiempo"=>5, "prioridad"=>3, "origen"=>"192.168.1.10", "destino"=>"192.168.1.20"],
    ["id"=>2, "tiempo"=>2, "prioridad"=>1, "origen"=>"192.168.1.15", "destino"=>"192.168.1.25"],
    ["id"=>3, "tiempo"=>8, "prioridad"=>2, "origen"=>"192.168.1.30", "destino"=>"192.168.1.40"],
    ["id"=>4, "tiempo"=>1, "prioridad"=>5, "origen"=>"192.168.1.45", "destino"=>"192.168.1.55"],
    ["id"=>5, "tiempo"=>6, "prioridad"=>4, "origen"=>"192.168.1.60", "destino"=>"192.168.1.70"],
    ["id"=>6, "tiempo"=>3, "prioridad"=>2, "origen"=>"192.168.1.75", "destino"=>"192.168.1.85"],
    ["id"=>7, "tiempo"=>7, "prioridad"=>1, "origen"=>"192.168.1.90", "destino"=>"192.168.1.100"],
    ["id"=>8, "tiempo"=>4, "prioridad"=>3, "origen"=>"192.168.1.105", "destino"=>"192.168.1.115"],
    ["id"=>9, "tiempo"=>9, "prioridad"=>5, "origen"=>"192.168.1.120", "destino"=>"192.168.1.130"],
    ["id"=>10, "tiempo"=>2, "prioridad"=>4, "origen"=>"192.168.1.135", "destino"=>"192.168.1.145"]
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
    <a class="btn btn-sm btn-outline-warning" href="?ordenar=id">ID</a>
</p>

<div class="alert alert-info">
    <strong>Prioridad:</strong> 1 (Más alta) - 5 (Más baja)
</div>

<table id="tablaPaquetes" class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tiempo</th>
            <th>Prioridad</th>
            <th>Origen</th>
            <th>Destino</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($paquetes as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p["id"]) ?></td>
                <td><?= htmlspecialchars($p["tiempo"]) ?> ms</td>
                <td>
                    <span class="badge bg-<?= 
                        $p['prioridad'] == 1 ? 'danger' : 
                        ($p['prioridad'] == 2 ? 'warning' : 
                        ($p['prioridad'] == 3 ? 'info' : 'secondary')) 
                    ?>">
                        <?= htmlspecialchars($p["prioridad"]) ?>
                    </span>
                </td>
                <td><code><?= htmlspecialchars($p["origen"]) ?></code></td>
                <td><code><?= htmlspecialchars($p["destino"]) ?></code></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- REMOVER DataTables para que funcione el ordenamiento del servidor -->
<?php include("../includes/footer.php"); ?>