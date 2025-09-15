<?php include("../includes/header.php"); ?>

<div class="container mt-4">
    <!-- Diagrama de estructuras -->
    <h1>Diagrama de Estructuras - Metodos Simples</h1>
    <p>El siguiente diagrama muestra la relación entre las estructuras usadas en este laboratorio.</p>
    <div class="text-center mb-4">
        <img src="../img/diagrama.png" alt="Diagrama de estructuras" class="img-fluid">
    </div>

    <!-- Explicación del diagrama -->
    <h3>Explicación del diagrama</h3>
    <p>
        <ul>
            <li><b>index.php</b> → Entrada principal con menú lateral y manual de usuario.</li>
            <li>Desde index.php se accede a los 3 módulos principales:</li>
            <ul>
                <li><b>biblioteca.php</b> → Gestor de libros.</li>
                <li><b>banco.php</b> → Cola de clientes.</li>
                <li><b>red.php</b> → Simulación de paquetes.</li>
            </ul>
            <li>Todos los módulos, junto con <b>sort.php</b>, hacen llamadas a <b>algoritmos.php</b>, donde se implementan los algoritmos de ordenamiento.</li>
            <li><b>sort.php</b> es especial, porque muestra los tiempos comparativos de cada algoritmo.</li>
        </ul>
    </p>

    <!-- Manual de Usuario -->
    <h1>Manual de Usuario - Metodos Simples</h1>

    <h3>1. Acceso al sistema</h3>
    <p>
        En el menú lateral encontrarás una sección llamada <b>Metodos_Simples</b>.  
        Dentro se listan todas las opciones del laboratorio:
    </p>
    <ul>
        <li><b>Inicio:</b> Presentación del laboratorio, manual y diagrama.</li>
        <li><b>Comparación Algoritmos:</b> Prueba y compara los tiempos de ejecución de <i>MergeSort, QuickSort y BubbleSort</i>.</li>
        <li><b>Biblioteca:</b> Ordena libros por título, autor o año.</li>
        <li><b>Simulador de Red:</b> Ordena paquetes según tiempo de llegada o prioridad.</li>
        <li><b>Cola de Banco:</b> Ordena clientes por turno o prioridad (VIP / Normal).</li>
    </ul>

    <h3>2. Navegación</h3>
    <p>
        Usa el menú lateral para moverte entre módulos.  
        También puedes usar el menú superior para volver a la página principal.
    </p>

    <h3>3. Opciones de Ordenamiento</h3>
    <p>
        En cada módulo (Biblioteca, Red y Banco) puedes elegir el criterio de ordenamiento haciendo clic en los enlaces disponibles sobre la tabla.  
        Los datos se reorganizan automáticamente según la opción seleccionada.
    </p>

    <h3>4. Comparación de Algoritmos</h3>
    <p>
        En el módulo <b>Comparación Algoritmos</b> puedes generar arreglos de distintos tamaños y observar cómo varía el tiempo de ejecución entre los diferentes algoritmos implementados.
    </p>
</div>

<?php include("../includes/footer.php"); ?>
