<?php
// Clase Nodo
class Nodo {
    public $dato;
    public $siguiente;
    public function __construct($dato) {
        $this->dato = $dato;
        $this->siguiente = null;
    }
}

// Clase Lista Enlazada Simple
class ListaEnlazada {
    public $cabeza;
    public function __construct() { $this->cabeza = null; }

    // Insertar al final
    public function insertar($dato) {
        $nuevo = new Nodo($dato);
        if ($this->cabeza === null) {
            $this->cabeza = $nuevo;
            return;
        }
        $actual = $this->cabeza;
        while ($actual->siguiente !== null) {
            $actual = $actual->siguiente;
        }
        $actual->siguiente = $nuevo;
    }

    // Eliminar la primera ocurrencia del dato
    public function eliminar($dato) {
        if ($this->cabeza === null) return false;

        if ($this->cabeza->dato == $dato) {
            $this->cabeza = $this->cabeza->siguiente;
            return true;
        }

        $actual = $this->cabeza;
        while ($actual->siguiente !== null && $actual->siguiente->dato != $dato) {
            $actual = $actual->siguiente;
        }

        if ($actual->siguiente === null) return false;

        $actual->siguiente = $actual->siguiente->siguiente;
        return true;
    }

    // Devuelve un array con los elementos en orden
    public function mostrar() {
        $actual = $this->cabeza;
        $items = [];
        while ($actual !== null) {
            $items[] = $actual->dato;
            $actual = $actual->siguiente;
        }
        return $items;
    }
}

/*
  Lógica del request:
  - Usamos un input hidden "lista_json" para recibir el estado previo (array JSON)
  - Reconstruimos la lista, aplicamos insertar/eliminar/reset y luego convertimos de nuevo a JSON
*/

$default_list = [5, 8, 12, 20, 3];
$lista_array = $default_list;
$resultado = "";

// Si viene POST intentamos leer el JSON enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['lista_json'])) {
        $decoded = json_decode($_POST['lista_json'], true);
        if (is_array($decoded)) $lista_array = $decoded;
    }

    // Construimos la lista desde el array recibido
    $lista = new ListaEnlazada();
    foreach ($lista_array as $v) $lista->insertar(intval($v));

    // Acciones
    if (isset($_POST['insertar'])) {
        $num = intval($_POST['numero']);
        $lista->insertar($num);
        $resultado = "Número <b>$num</b> insertado en la lista.";
    } elseif (isset($_POST['eliminar'])) {
        $num = intval($_POST['numero']);
        if ($lista->eliminar($num)) {
            $resultado = "Número <b>$num</b> eliminado de la lista.";
        } else {
            $resultado = "Número <b>$num</b> no encontrado en la lista.";
        }
    } elseif (isset($_POST['reset'])) {
        $lista = new ListaEnlazada();
        foreach ($default_list as $v) $lista->insertar($v);
        $resultado = "Lista reiniciada al valor por defecto.";
    }

    // Obtenemos el array actualizado
    $lista_array = $lista->mostrar();
}

// JSON para enviar de vuelta en el form (escape para seguridad)
$lista_json = htmlspecialchars(json_encode($lista_array), ENT_QUOTES, 'UTF-8');
?>

<?php include("includes/header.php"); ?>

<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Estructura de Datos</a>
    </div>
</nav>

<!-- Page content -->
<div class="container mt-5">
    <div class="text-center">
        <h2>Lista Enlazada Simple — Inserción y Eliminación</h2>
        <p class="text-muted">Estado actual de la lista (persistencia sin sesiones)</p>

        <!-- Formulario -->
        <form method="POST" class="mb-3">
            <div class="input-group mb-3 justify-content-center">
                <input type="number" class="form-control" name="numero" placeholder="Ingrese un número" required style="max-width:200px;">
                <button class="btn btn-success" type="submit" name="insertar">Insertar</button>
                <button class="btn btn-danger" type="submit" name="eliminar">Eliminar</button>
                <button class="btn btn-secondary" type="submit" name="reset">Reset</button>
            </div>

            <!-- Campo oculto con el estado actual de la lista -->
            <input type="hidden" name="lista_json" value="<?= $lista_json ?>">
        </form>

        <!-- Resultado -->
        <div class="alert alert-info">
            <?php
            if ($resultado !== "") echo $resultado . "<br><br>";

            if (count($lista_array) === 0) {
                echo "<b>Lista actual:</b> <i>(vacía)</i>";
            } else {
                // Muestra en formato textual y una vista "visual" con badges y flechas
                echo "<b>Lista actual:</b> [ " . implode(", ", $lista_array) . " ]<br><br>";

                // Visual sencillo usando badges y flechas
                foreach ($lista_array as $i => $val) {
                    echo '<span class="badge bg-secondary p-2 me-1">' . htmlspecialchars($val) . '</span>';
                    if ($i < count($lista_array) - 1) {
                        echo '<span class="mx-1">→</span>';
                    }
                }
            }
            ?>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
