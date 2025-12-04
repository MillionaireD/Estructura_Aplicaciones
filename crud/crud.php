<?php
// Session debe ir PRIMERO, antes de cualquier include
session_start();

// Incluir header (con HTML, Bootstrap y sidebar)
include("../includes/header.php");

// Inicializar array si no existe
if (!isset($_SESSION['arreglo_dinamico'])) {
    $_SESSION['arreglo_dinamico'] = array();
}

$arreglo = $_SESSION['arreglo_dinamico'];
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">CRUD - Arreglo Dinámico</h1>
    
    <div class="row">
        <div class="col-md-6">
            <!-- Formulario para insertar -->
            <div class="card">
                <div class="card-header">
                    <h5>Insertar Elemento</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="procesar_crud.php">
                        <input type="hidden" name="accion" value="insertar">
                        <div class="mb-3">
                            <label for="elemento" class="form-label">Elemento:</label>
                            <input type="text" class="form-control" id="elemento" name="elemento" required>
                        </div>
                        <button type="submit" class="btn btn-success">Insertar</button>
                    </form>
                </div>
            </div>

            <!-- Formulario para buscar -->
            <div class="card mt-3">
                <div class="card-header">
                    <h5>Buscar Elemento</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="procesar_crud.php">
                        <input type="hidden" name="accion" value="buscar">
                        <div class="mb-3">
                            <label for="valor_buscar" class="form-label">Valor a buscar:</label>
                            <input type="text" class="form-control" id="valor_buscar" name="valor">
                        </div>
                        <button type="submit" class="btn btn-info">Buscar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Formulario para actualizar -->
            <div class="card">
                <div class="card-header">
                    <h5>Actualizar Elemento</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="procesar_crud.php">
                        <input type="hidden" name="accion" value="actualizar">
                        <div class="mb-3">
                            <label for="indice_actualizar" class="form-label">Índice:</label>
                            <input type="number" class="form-control" id="indice_actualizar" name="indice" required>
                        </div>
                        <div class="mb-3">
                            <label for="nuevo_valor" class="form-label">Nuevo Valor:</label>
                            <input type="text" class="form-control" id="nuevo_valor" name="nuevo_valor" required>
                        </div>
                        <button type="submit" class="btn btn-warning">Actualizar</button>
                    </form>
                </div>
            </div>

            <!-- Formulario para eliminar -->
            <div class="card mt-3">
                <div class="card-header">
                    <h5>Eliminar Elemento</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="procesar_crud.php">
                        <input type="hidden" name="accion" value="eliminar">
                        <div class="mb-3">
                            <label for="indice_eliminar" class="form-label">Índice a eliminar:</label>
                            <input type="number" class="form-control" id="indice_eliminar" name="indice" required>
                        </div>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Mostrar resultados y array actual -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Array Actual y Resultados</h5>
                </div>
                <div class="card-body">
                    <h6>Array Actual:</h6>
                    <?php if (empty($arreglo)): ?>
                        <p class="text-muted">El array está vacío</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Índice</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($arreglo as $indice => $valor): ?>
                                    <tr>
                                        <td><?php echo $indice; ?></td>
                                        <td><?php echo htmlspecialchars($valor); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <p><strong>Total de elementos:</strong> <?php echo count($arreglo); ?></p>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['resultado'])): ?>
                        <div class="alert alert-info mt-3">
                            <h6>Resultado:</h6>
                            <p><?php echo $_SESSION['resultado']; ?></p>
                        </div>
                        <?php unset($_SESSION['resultado']); ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['resultado_busqueda'])): ?>
                        <div class="alert alert-warning mt-3">
                            <h6>Resultado de Búsqueda:</h6>
                            <p><?php echo $_SESSION['resultado_busqueda']; ?></p>
                        </div>
                        <?php unset($_SESSION['resultado_busqueda']); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Incluir footer (cierra body y html)
include("../includes/footer.php");
?>