<footer class="footer mt-auto py-4 bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <h6 class="fw-bold mb-2"><i class="fas fa-dumbbell"></i> <?= $config['nombre_sistema'] ?? 'Gym System' ?></h6>
                <p class="text-muted small mb-0">Sistema de administración completo para tu gimnasio</p>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <h6 class="fw-bold mb-2"><i class="fas fa-info-circle"></i> Información</h6>
                <ul class="list-unstyled text-muted small">
                    <li><a href="#" class="text-decoration-none text-muted">Ayuda</a></li>
                    <li><a href="#" class="text-decoration-none text-muted">Contacto</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="fw-bold mb-2"><i class="fas fa-copyright"></i> Derechos</h6>
                <p class="text-muted small mb-0">&copy; <span id="year"></span> <?= $config['nombre_sistema'] ?? 'Gym System' ?>. Todos los derechos reservados.</p>
            </div>
        </div>
        <hr class="my-3 bg-secondary">
        <div class="text-center text-muted small">
            <p class="mb-0">Sistema desarrollado con profesionalismo • Versión 1.0</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Configurar año automáticamente
    document.getElementById('year').textContent = new Date().getFullYear();

    $(document).ready(function() {
        // Inicializar DataTables - Destruir si ya existe
        var table = $('.table-data');
        if (table.length) {
            // Si DataTables ya está inicializada, destruirla
            if ($.fn.DataTable.isDataTable(table)) {
                table.DataTable().destroy();
            }
            
            // Inicializar DataTables
            table.DataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                "pageLength": 10,
                "lengthMenu": [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
                "dom": "<'row mb-3'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                       "<'row'<'col-sm-12'tr>>" +
                       "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "searching": true,
                "ordering": true,
                "paging": true,
                "info": true,
                "drawCallback": function() {
                    $('[data-bs-toggle="tooltip"]').each(function() {
                        var tooltip = bootstrap.Tooltip.getInstance(this);
                        if (!tooltip) {
                            new bootstrap.Tooltip(this);
                        }
                    });
                }
            });
        }

        // SweetAlert para confirmaciones
        $('.btn-confirm').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');
            const title = $(this).data('title') || '¿Estás seguro?';

            Swal.fire({
                title: title,
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DC2626',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-check"></i> Sí, confirmar',
                cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                    cancelButton: 'btn btn-secondary'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });

        // Animación de tooltips
        $('[data-bs-toggle="tooltip"]').each(function() {
            var tooltip = bootstrap.Tooltip.getInstance(this);
            if (!tooltip) {
                new bootstrap.Tooltip(this);
            }
        });
    });
</script>
    <!-- Sidebar -->
    <?php require_once __DIR__ . '/sidebar.php'; ?>

</div><!-- end main-content -->

</body>
</html>