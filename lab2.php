<?php include 'includes/header.php'; ?>

<div class="container mt-4">
    <h2 class="mb-4">Laboratorio: Listas Enlazadas y Validación de Paréntesis</h2>

    <!-- ================== DESCRIPCIÓN DEL LABORATORIO ================== -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-dark text-white">
            Cómo usar este laboratorio
        </div>
        <div class="card-body">
            <p>Este laboratorio tiene dos módulos principales:</p>
            <ol>
                <li><b>Lista Enlazada:</b> permite agregar, eliminar y recorrer varios elementos en tiempo real. Cada elemento se muestra como un cuadro gris.</li>
                <li><b>Validación de Paréntesis:</b> escribe una expresión con paréntesis <code>()</code>, corchetes <code>[]</code> o llaves <code>{}</code> y pulsa "Validar". Te dirá si la expresión está <b>balanceada</b> o <b>no balanceada</b>.</li>
            </ol>
        </div>
    </div>

    <!-- ================== LISTA ENLAZADA ================== -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-dark text-white">
            Lista Enlazada (Insertar, Eliminar y Recorrer)
        </div>
        <div class="card-body">
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <input type="text" id="listData" class="form-control" placeholder="Dato a insertar o eliminar">
                </div>
                <div class="col-md-6">
                    <button id="insertBtn" class="btn btn-primary">Insertar</button>
                    <button id="deleteBtn" class="btn btn-danger">Eliminar</button>
                    
                </div>
            </div>

            <div>
                <h6>Estado de la lista:</h6>
                <div id="listContainer" style="display:flex; gap:5px; flex-wrap: wrap;">
                    <span>Lista vacía</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ================== VALIDACIÓN DE PARÉNTESIS ================== -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-dark text-white">
            Validación de Paréntesis Balanceados (Pilas)
        </div>
        <div class="card-body">
            <div class="row g-3 mb-3">
                <div class="col-md-8">
                    <input type="text" id="expression" class="form-control" placeholder="Escribe una expresión">
                </div>
                <div class="col-md-4">
                    <button id="validateBtn" class="btn btn-primary">Validar</button>
                </div>
            </div>
            <div>
                <h6>Resultado:</h6>
                <pre id="validationResult">Ingresa una expresión y pulsa "Validar".</pre>
            </div>
        </div>
    </div>
</div>

<!-- Incluye tu footer -->
<?php include 'includes/footer.php'; ?>
