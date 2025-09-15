<?php
include("algoritmos.php");

$libros = [
    ["titulo"=>"Harry Potter", "autor"=>"Rowling", "anio"=>1997],
    ["titulo"=>"Cien Años de Soledad", "autor"=>"García Márquez", "anio"=>1967],
    ["titulo"=>"El Quijote", "autor"=>"Cervantes", "anio"=>1605],
    ["titulo"=>"It", "autor"=>"Stephen King", "anio"=>1986],
];

// Criterio de ordenamiento desde GET
$criterio = $_GET['ordenar'] ?? "titulo";

usort($libros, function($a, $b) use ($criterio) {
    return strcmp($a[$criterio], $b[$criterio]);
});

include("../includes/header.php");

?>

<h2> Biblioteca</h2>
<p>Ordenar por:
    <a class="btn btn-sm btn-outline-primary" href="?ordenar=titulo">Título</a>
    <a class="btn btn-sm btn-outline-success" href="?ordenar=autor">Autor</a>
    <a class="btn btn-sm btn-outline-warning" href="?ordenar=anio">Año</a>
</p>

<table id="tablaLibros" class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Año</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($libros as $l): ?>
            <tr>
                <td><?= htmlspecialchars($l["titulo"]) ?></td>
                <td><?= htmlspecialchars($l["autor"]) ?></td>
                <td><?= htmlspecialchars($l["anio"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
document.addEventListener("DOMContentLoaded", function() {
    new DataTable('#tablaLibros');
});
</script>

<?php include("../includes/footer.php"); ?>
