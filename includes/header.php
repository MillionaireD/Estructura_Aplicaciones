<?php
// includes/header.php
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Proyecto de Ordenamiento</title>
    <link rel="stylesheet" href="/Labs/css/styles.css"> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- ORDEN CORRECTO: jQuery primero, luego Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-light">Menú</div>
            <div class="list-group list-group-flush">

                <!-- Inicio fuera de los laboratorios -->
                <a class="list-group-item list-group-item-action p-3" href="/index.php">🏠 Inicio</a>

                <!-- Laboratorio 2 con submenú -->
                <a class="list-group-item list-group-item-action p-3 d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" href="#lab2Menu" role="button" aria-expanded="false" aria-controls="lab2Menu">
                    Metodos Simples
                    <span class="ms-2">▼</span>
                </a>
                <div class="collapse" id="lab2Menu">
                    <div class="list-group">
                        <a class="list-group-item list-group-item-action ps-5" href="/Metodos_Simples/Metodos_inicio.php">Inicio</a>
                        <a class="list-group-item list-group-item-action ps-5" href="/Metodos_Simples/sort.php">Comparación Algoritmos</a>
                        <a class="list-group-item list-group-item-action ps-5" href="/Metodos_Simples/biblioteca.php">Biblioteca</a>
                        <a class="list-group-item list-group-item-action ps-5" href="/Metodos_Simples/red.php">Simulador de Red</a>
                        <a class="list-group-item list-group-item-action ps-5" href="/Metodos_Simples/banco.php">Cola de Banco</a>
                    </div>
                </div>

                <!-- Listas Enlazadas con submenú -->
                <a class="list-group-item list-group-item-action p-3 d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" href="#listasMenu" role="button"
                    aria-expanded="<?= $listasAbierto ? 'true' : 'false' ?>" aria-controls="listasMenu">
                    Listas Enlazadas
                    <span class="ms-2">▼</span>
                </a>
                <div class="collapse <?= $listasAbierto ?>" id="listasMenu">
                    <div class="list-group">
                        <a class="list-group-item list-group-item-action ps-5" href="/enlazada.php">Enlazada o Arreglo</a>
                        <a class="list-group-item list-group-item-action ps-5" href="/enlazada_simple.php">Lista Simplemente Enlazada</a>
                    </div>
                </div>


                <!-- Laboratorio 3 con submenú -->
                <a class="list-group-item list-group-item-action p-3 d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" href="#lab3Menu" role="button" aria-expanded="<?= $lab3Abierto ? 'true' : 'false' ?>" aria-controls="lab3Menu">
                    Mini-Proyecto
                    <span class="ms-2">▼</span>
                </a>
                <div class="collapse <?= $lab3Abierto ?>" id="lab3Menu">
                    <div class="list-group">
                        <a class="list-group-item list-group-item-action ps-5" href="/miniproyecto/agenda.php">Inicio</a>
                        <a class="list-group-item list-group-item-action ps-5" href="#">Ejemplo 1</a>
                        <a class="list-group-item list-group-item-action ps-5" href="#">Ejemplo 2</a>
                    </div>
                </div>
                <!-- Opción directa para el módulo BFS/DFS -->
                <a class="list-group-item list-group-item-action p-3" href="/bfs_dfs.php">BFS y DFS</a>
                <a class="list-group-item list-group-item-action p-3" href="/Labs/crud/crud.php">Crud Simple</a>
                <a class="list-group-item list-group-item-action p-3" href="/lab2.php">Laboratorio 2</a>
                <a class="list-group-item list-group-item-action p-3" href="/lab1.php">Laboratorio 1</a>


            </div>
        </div>
        <!-- Page content wrapper -->
        <div id="page-content-wrapper">
            <!-- Top navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-primary" id="sidebarToggle">☰ Menú</button>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page content -->
            <div class="container-fluid mt-4">