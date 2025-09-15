<?php
class Nodo {
    public $dato;
    public $siguiente;

    public function __construct($dato) {
        $this->dato = $dato;
        $this->siguiente = null;
    }
}

class ListaEnlazada {
    private $cabeza = null;

    public function insertar($dato) {
        $nuevo = new Nodo($dato);
        if ($this->cabeza === null) {
            $this->cabeza = $nuevo;
        } else {
            $actual = $this->cabeza;
            while ($actual->siguiente !== null) {
                $actual = $actual->siguiente;
            }
            $actual->siguiente = $nuevo;
        }
    }

    public function eliminar($dato) {
        if ($this->cabeza === null) return;

        if ($this->cabeza->dato === $dato) {
            $this->cabeza = $this->cabeza->siguiente;
            return;
        }

        $actual = $this->cabeza;
        while ($actual->siguiente !== null && $actual->siguiente->dato !== $dato) {
            $actual = $actual->siguiente;
        }

        if ($actual->siguiente !== null) {
            $actual->siguiente = $actual->siguiente->siguiente;
        }
    }

    public function recorrer() {
        $actual = $this->cabeza;
        $resultado = [];
        while ($actual !== null) {
            $resultado[] = $actual->dato;
            $actual = $actual->siguiente;
        }
        return $resultado;
    }
}

// Lista de lo utilizado
$lista = new ListaEnlazada();
$lista->insertar(10);
$lista->insertar(20);
$lista->insertar(30);

echo "Lista inicial: " . implode(" → ", $lista->recorrer()) . PHP_EOL;

$lista->eliminar(20);
echo "Lista después de eliminar 20: " . implode(" → ", $lista->recorrer()) . PHP_EOL;
?>
