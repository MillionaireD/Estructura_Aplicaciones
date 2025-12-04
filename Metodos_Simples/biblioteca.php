<?php
include("algoritmos.php");

$libros = [
    ["titulo"=>"Harry Potter", "autor"=>"Rowling", "anio"=>1997, "genero"=>"Fantasía"],
    ["titulo"=>"Cien Años de Soledad", "autor"=>"García Márquez", "anio"=>1967, "genero"=>"Realismo Mágico"],
    ["titulo"=>"El Quijote", "autor"=>"Cervantes", "anio"=>1605, "genero"=>"Novela"],
    ["titulo"=>"It", "autor"=>"Stephen King", "anio"=>1986, "genero"=>"Terror"],
    ["titulo"=>"1984", "autor"=>"George Orwell", "anio"=>1949, "genero"=>"Ciencia Ficción"],
    ["titulo"=>"Orgullo y Prejuicio", "autor"=>"Jane Austen", "anio"=>1813, "genero"=>"Romance"],
    ["titulo"=>"Crimen y Castigo", "autor"=>"Dostoievski", "anio"=>1866, "genero"=>"Filosófica"],
    ["titulo"=>"El Señor de los Anillos", "autor"=>"Tolkien", "anio"=>1954, "genero"=>"Fantasía"],
    ["titulo"=>"Don Quijote de la Mancha", "autor"=>"Cervantes", "anio"=>1615, "genero"=>"Novela"],
    ["titulo"=>"Drácula", "autor"=>"Bram Stoker", "anio"=>1897, "genero"=>"Terror"]
];

// Criterio de ordenamiento desde GET
$criterio = $_GET['ordenar'] ?? "titulo";

usort($libros, function($a, $b) use ($criterio) {
    if ($criterio == "anio") {
        return $a[$criterio] <=> $b[$criterio];
    } else {
        return strcmp($a[$criterio], $b[$criterio]);
    }
});

include("../includes/header.php");
?>

<h2>Biblioteca</h2>
<p>Ordenar por:
    <a class="btn btn-sm btn-outline-primary" href="?ordenar=titulo">Título</a>
    <a class="btn btn-sm btn-outline-success" href="?ordenar=autor">Autor</a>
    <a class="btn btn-sm btn-outline-warning" href="?ordenar=anio">Año</a>
    <a class="btn btn-sm btn-outline-info" href="?ordenar=genero">Género</a>
</p>

<table id="tablaLibros" class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Año</th>
            <th>Género</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($libros as $l): ?>
            <tr>
                <td><strong><?= htmlspecialchars($l["titulo"]) ?></strong></td>
                <td><?= htmlspecialchars($l["autor"]) ?></td>
                <td><?= htmlspecialchars($l["anio"]) ?></td>
                <td><?= htmlspecialchars($l["genero"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- REMOVER DataTables para que funcione el ordenamiento del servidor -->
<?php include("../includes/footer.php"); ?>