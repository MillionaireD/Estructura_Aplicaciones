<?php
include("lista.php");
if (session_status() === PHP_SESSION_NONE) session_start();
include("../includes/header.php");

$agenda = $_SESSION['agenda'] ?? new ListaEnlazada();
$_SESSION['agenda'] = $agenda;

$contactos = $agenda->obtenerTodos() ?? [];
?>

<div class="container mt-4">
    <h2>📒 Agenda de Contactos</h2>

    <div class="mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregar">
            ➕ Agregar Contacto
        </button>
        <input type="text" id="buscarContacto" class="form-control mt-2" placeholder="Buscar contactos...">
    </div>

    <table id="tablaContactos" class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="listaContactos">
            <?php foreach ($contactos as $c): ?>
            <tr>
                <td><?= htmlspecialchars($c->nombre) ?></td>
                <td><?= htmlspecialchars($c->telefono) ?></td>
                <td><?= htmlspecialchars($c->email) ?></td>
                <td>
                    <button class="btn btn-warning btn-sm editar" 
                        data-nombre="<?= htmlspecialchars($c->nombre) ?>" 
                        data-telefono="<?= htmlspecialchars($c->telefono) ?>" 
                        data-email="<?= htmlspecialchars($c->email) ?>">✏️</button>
                    <button class="btn btn-danger btn-sm eliminar" data-nombre="<?= htmlspecialchars($c->nombre) ?>">❌</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Agregar/Editar -->
<div class="modal fade" id="modalAgregar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Contacto</h5>
        <!-- BOTON DE CANCELAR - INICIO (X) -->
      </div>
      <div class="modal-body">
        <form id="formAgregar">
          <input type="hidden" name="modo" id="modo" value="agregar">
          <input type="hidden" name="nombre_original" id="nombre_original">
          <div class="mb-3">
            <label>Nombre</label>
            <input type="text" class="form-control" name="nombre" required>
          </div>
          <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" class="form-control" name="telefono" required>
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" name="email" required>
          </div>
          <div class="text-end">
            <!-- AGREGAMOS BOTÓN CANCELAR -->
            <button type="button" class="btn btn-secondary me-2" id="btnCancelar">Cancelar</button>
            <button type="submit" class="btn btn-success">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ... FALTA ARRERGLAR ESTRUCTURA JS EN EL ARCHIVO PRINCIPAL SCRIPT.JS PARA SIMPLIFICAR ... -->

<?php include("../includes/footer.php"); ?>
<script>
$(document).ready(function(){
    const modal = new bootstrap.Modal(document.getElementById('modalAgregar'));
    
    // Botón Cancelar - Cierra el modal
    $("#btnCancelar").click(function(){
        modal.hide();
    });
    
    // Abrir modal para agregar
    $('[data-bs-target="#modalAgregar"]').click(function(){
        $('#modo').val('agregar');
        $('.modal-title').text('Agregar Contacto');
        $('#formAgregar')[0].reset();
    });

    // Enviar formulario
    $("#formAgregar").on("submit", function(e){
        e.preventDefault();
        
        const formData = $(this).serialize();
        const accion = $('#modo').val() === "editar" ? "editar" : "agregar";
        
        $.post("procesar.php", formData + "&accion=" + accion, function(res){
            const data = JSON.parse(res);
            if(data.status === "ok"){
                modal.hide(); // Cerramos el modal
                location.reload(); // Recargamos la página
            } else {
                alert("Error: " + (data.message || "Error desconocido"));
            }
        }).fail(function(){
            alert("Error de conexión");
        });
    });

    // Editar contacto
    $("#listaContactos").on("click", ".editar", function(){
        const nombre = $(this).data('nombre');
        const telefono = $(this).data('telefono');
        const email = $(this).data('email');
        
        $('[name="nombre"]').val(nombre);
        $('[name="telefono"]').val(telefono);
        $('[name="email"]').val(email);
        $('#nombre_original').val(nombre);
        $('#modo').val('editar');
        $('.modal-title').text('Editar Contacto');
        
        modal.show();
    });

    // Eliminar contacto
    $("#listaContactos").on("click", ".eliminar", function(){
        if(confirm("¿Seguro que quieres eliminar este contacto?")){
            const nombre = $(this).data('nombre');
            
            $.post("procesar.php", {accion: "eliminar", nombre: nombre}, function(res){
                const data = JSON.parse(res);
                if(data.status === "ok"){
                    location.reload();
                } else {
                    alert("Error al eliminar");
                }
            });
        }
    });

    // Búsqueda
    $("#buscarContacto").on("keyup", function(){
        const valor = $(this).val().toLowerCase();
        $("#listaContactos tr").filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(valor) > -1);
        });
    });
});
</script>
