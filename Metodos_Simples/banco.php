<?php
include("algoritmos.php");

$clientes = [
    ["nombre"=>"Ana", "turno"=>5, "tipo"=>"Normal"],
    ["nombre"=>"Luis", "turno"=>2, "tipo"=>"VIP"],
    ["nombre"=>"Pedro", "turno"=>8, "tipo"=>"Normal"],
    ["nombre"=>"Marta", "turno"=>1, "tipo"=>"VIP"],
    ["nombre"=>"Carlos", "turno"=>3, "tipo"=>"Normal"],
    ["nombre"=>"Elena", "turno"=>6, "tipo"=>"VIP"],
    ["nombre"=>"Roberto", "turno"=>4, "tipo"=>"Normal"],
    ["nombre"=>"Sofia", "turno"=>7, "tipo"=>"VIP"],
    ["nombre"=>"Miguel", "turno"=>9, "tipo"=>"Normal"],
    ["nombre"=>"Isabel", "turno"=>10, "tipo"=>"VIP"]
];

// Ordenar por criterio
$criterio = $_GET['ordenar'] ?? "turno";

if($criterio == "tipo") {
    // Priorizar VIP sobre Normal, y dentro del mismo tipo ordenar por turno
    usort($clientes, function($a, $b) {
        if ($a["tipo"] == $b["tipo"]) {
            return $a["turno"] <=> $b["turno"];
        }
        return ($a["tipo"] == "VIP") ? -1 : 1;
    });
} else {
    usort($clientes, function($a, $b) use ($criterio) {
        return $a[$criterio] <=> $b[$criterio];
    });
}

include("../includes/header.php");
?>

<h2>Sistema de Colas de Banco</h2>
<p>Ordenar clientes por:
    <a class="btn btn-sm btn-outline-primary" href="?ordenar=turno">Turno</a>
    <a class="btn btn-sm btn-outline-success" href="?ordenar=tipo">Tipo (VIP primero)</a>
    <a class="btn btn-sm btn-outline-warning" href="?ordenar=nombre">Nombre</a>
</p>

<table id="tablaClientes" class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Nombre</th>
            <th>Turno</th>
            <th>Tipo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($clientes as $c): ?>
            <tr>
                <td><?= htmlspecialchars($c["nombre"]) ?></td>
                <td><?= htmlspecialchars($c["turno"]) ?></td>
                <td>
                    <span class="badge <?= $c['tipo'] == 'VIP' ? 'bg-warning' : 'bg-secondary' ?>">
                        <?= htmlspecialchars($c["tipo"]) ?>
                    </span>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- REMOVER DataTables para que funcione el ordenamiento del servidor -->
<?php include("../includes/footer.php"); ?>