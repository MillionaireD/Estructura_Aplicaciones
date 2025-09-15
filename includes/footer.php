            </div> <!-- cierre container-fluid -->
        </div> <!-- cierre page-content-wrapper -->
    </div> <!-- cierre wrapper -->

 <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Sidebar toggle script -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const sidebarToggle = document.getElementById("sidebarToggle");
    if (sidebarToggle) {
        sidebarToggle.addEventListener("click", function(e) {
            e.preventDefault();
            document.body.classList.toggle("sb-sidenav-toggled");
        });
    }
});
</script>

<!-- Nuestro script para lista enlazada y paréntesis -->
<script src="/js/scripts.js"></script>

</body>
</html>
