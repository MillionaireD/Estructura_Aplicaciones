<?php
include("lista.php");
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['agenda'])) $_SESSION['agenda'] = new ListaEnlazada();
$agenda = $_SESSION['agenda'];

$accion = $_POST['accion'] ?? '';

if ($accion === 'agregar') {
    $nombre = trim($_POST['nombre']);
    $telefono = trim($_POST['telefono']);
    $email = trim($_POST['email']);
    $agenda->insertar($nombre, $telefono, $email);
    $_SESSION['agenda'] = $agenda;

    echo json_encode([
        "status" => "ok",
        "contacto" => ["nombre"=>$nombre, "telefono"=>$telefono, "email"=>$email]
    ]);
    exit;
}

if ($accion === 'eliminar') {
    $nombre = $_POST['nombre'];
    $ok = $agenda->eliminar($nombre);
    $_SESSION['agenda'] = $agenda;
    echo json_encode(["status" => $ok ? "ok" : "error"]);
    exit;
}

if ($accion === 'editar') {
    $nombre_original = $_POST['nombre_original'];
    $nuevo_nombre = trim($_POST['nombre']);
    $telefono = trim($_POST['telefono']);
    $email = trim($_POST['email']);

    $agenda->eliminar($nombre_original);
    $agenda->insertar($nuevo_nombre, $telefono, $email);
    $_SESSION['agenda'] = $agenda;

    echo json_encode([
        "status"=>"ok",
        "contacto"=>[
            "nombre"=>$nuevo_nombre,
            "telefono"=>$telefono,
            "email"=>$email,
            "nombre_original"=>$nombre_original
        ]
    ]);
    exit;
}
