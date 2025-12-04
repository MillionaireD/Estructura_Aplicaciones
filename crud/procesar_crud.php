<?php
// Iniciar sesión al inicio del archivo
session_start();

if (!isset($_SESSION['arreglo_dinamico'])) {
    $_SESSION['arreglo_dinamico'] = array();
}

$arreglo = &$_SESSION['arreglo_dinamico'];

if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
        case 'insertar':
            if (!empty($_POST['elemento'])) {
                $arreglo[] = $_POST['elemento'];
                $_SESSION['resultado'] = "Elemento '" . $_POST['elemento'] . "' insertado correctamente. Nuevo índice: " . (count($arreglo) - 1);
            }
            break;

        case 'buscar':
            if (!empty($_POST['valor'])) {
                $valor = $_POST['valor'];
                $encontrados = array();
                
                foreach ($arreglo as $indice => $elemento) {
                    if (strpos($elemento, $valor) !== false) {
                        $encontrados[] = "Índice $indice: $elemento";
                    }
                }
                
                if (!empty($encontrados)) {
                    $_SESSION['resultado_busqueda'] = "Elementos encontrados:<br>" . implode("<br>", $encontrados);
                } else {
                    $_SESSION['resultado_busqueda'] = "No se encontraron elementos con: '$valor'";
                }
            }
            break;

        case 'actualizar':
            $indice = $_POST['indice'];
            $nuevoValor = $_POST['nuevo_valor'];
            
            if (isset($arreglo[$indice])) {
                $valorAnterior = $arreglo[$indice];
                $arreglo[$indice] = $nuevoValor;
                $_SESSION['resultado'] = "Elemento actualizado:<br>Índice $indice: '$valorAnterior' → '$nuevoValor'";
            } else {
                $_SESSION['resultado'] = "Error: No existe el índice $indice";
            }
            break;

        case 'eliminar':
            $indice = $_POST['indice'];
            
            if (isset($arreglo[$indice])) {
                $elementoEliminado = $arreglo[$indice];
                unset($arreglo[$indice]);
                $arreglo = array_values($arreglo);
                $_SESSION['resultado'] = "Elemento eliminado: '$elementoEliminado' (índice $indice)";
            } else {
                $_SESSION['resultado'] = "Error: No existe el índice $indice";
            }
            break;
    }
}

header('Location: crud.php');
exit;
?>