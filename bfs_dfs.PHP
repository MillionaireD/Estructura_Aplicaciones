<?php
include("includes/header.php");
?>

<div class="container mt-4">
    <h2>Implementación de BFS y DFS</h2>
    <p>Este es un ejemplo de código en PHP para recorrer un grafo usando BFS y DFS. Puedes copiarlo y ejecutarlo en tu consola.</p>
    <p>Deberas crear un archivo con el nombre que quieras .php, luego navegar hasta la carpeta en donde se encuentre con la ayuda de la consola, posteriormente ejecutar el archivo de la siguiente manera: php elnombredelarchivo.php,
        esto ejecutara el archivo y mostrara los resultados en la consola.
    </p>

    <div class="card">
        <div class="card-body">
            <pre><code>&lt;?php
// Grafo de ejemplo
$grafo = [
    'A' =&gt; ['B', 'C'],
    'B' =&gt; ['A', 'D', 'E'],
    'C' =&gt; ['A', 'F'],
    'D' =&gt; ['B'],
    'E' =&gt; ['B', 'F'],
    'F' =&gt; ['C', 'E']
];

// BFS
function bfs($grafo, $inicio) {
    $visitados = [];
    $cola = [$inicio];
    $resultado = [];

    while (!empty($cola)) {
        $nodo = array_shift($cola);
        if (!in_array($nodo, $visitados)) {
            $visitados[] = $nodo;
            $resultado[] = $nodo;
            foreach ($grafo[$nodo] as $vecino) {
                if (!in_array($vecino, $visitados)) {
                    $cola[] = $vecino;
                }
            }
        }
    }
    return $resultado;
}

// DFS
function dfs($grafo, $inicio, &amp;$visitados = []) {
    $visitados[] = $inicio;
    foreach ($grafo[$inicio] as $vecino) {
        if (!in_array($vecino, $visitados)) {
            dfs($grafo, $vecino, $visitados);
        }
    }
    return $visitados;
}

// Nodo inicial
$inicio = 'A';

// Ejecutar
$bfs_result = bfs($grafo, $inicio);
$dfs_result = dfs($grafo, $inicio);

// Mostrar resultados en consola
echo "BFS desde nodo $inicio: " . implode(" → ", $bfs_result) . PHP_EOL;
echo "DFS desde nodo $inicio: " . implode(" → ", $dfs_result) . PHP_EOL;
?&gt;</code></pre>
        </div>
    </div>
</div>

<?php
include("includes/footer.php");
?>
