<?php
include("includes/header.php");
?>

<!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Estructura de Datos</a>
        </div>
    </nav>

    <!-- Page content-->
    <div class="container mt-5">
        <div class="text-center">
            <h2>Buscar número en el arreglo</h2>
            <p>Arreglo: [5, 8, 12, 20, 3]</p>

            <!-- Formulario -->
            <form method="POST" class="mb-3">
                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="numero" placeholder="Ingrese un número" required>
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </form>

            <!-- Resultado -->
            <div class="alert alert-info">
                <?php
                // Definir el arreglo
                $x = [5, 8, 12, 20, 3];

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $numero = intval($_POST["numero"]); // Leer número

                    // Procesar (O(n))
                    if (in_array($numero, $x)) {
                        echo " El número <b>$numero</b> existe en el arreglo.";
                    } else {
                        echo " El número <b>$numero</b> NO existe en el arreglo.";
                    }
                } else {
                    echo "Ingrese un número y presione 'Buscar'.";
                }
                ?>
            </div>
        </div>
    </div>

<?php
include("includes/footer.php");
?>
v