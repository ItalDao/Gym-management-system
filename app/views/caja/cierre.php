<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cierre de Caja - <?= $config['nombre_sistema'] ?? 'Gym' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body class="bg-light">

    <?php require_once '../app/views/inc/navbar.php'; ?>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <div class="card border-0 shadow">
                    <!-- Premium Header -->
                    <div style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%); padding: 40px 30px; text-align: center; color: white;">
                        <i class="fas fa-file-invoice-dollar" style="font-size: 40px; display: block; margin-bottom: 15px;"></i>
                        <h2 style="margin: 0 0 8px; font-weight: 800; font-size: 28px;">Cierre de Caja</h2>
                        <div style="opacity: 0.9; font-size: 13px; margin-top: 12px;">
                            <span><i class="fas fa-user-circle"></i> <?= $_SESSION['user_name'] ?></span> | 
                            <span><i class="fas fa-clock"></i> <?= date('d/m/Y H:i', strtotime($cajaAbierta['fecha_apertura'])) ?></span>
                        </div>
                    </div>
                    
                    <div class="card-body p-5">
                        
                        <!-- Resumen de Movimientos -->
                        <div class="row text-center mb-5">
                            <div class="col-md-4 mb-3">
                                <div style="padding: 20px; border-radius: 12px; background: linear-gradient(135deg, rgba(220, 38, 38, 0.1) 0%, rgba(153, 27, 27, 0.1) 100%); border-left: 4px solid #DC2626;">
                                    <small style="color: #999; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">Base Inicial</small>
                                    <h3 style="color: #d4af37; margin-top: 12px; margin-bottom: 0; font-weight: 800;"><?= $config['moneda'] ?> <?= number_format($monto_inicial, 2) ?></h3>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div style="padding: 20px; border-radius: 12px; background: linear-gradient(135deg, rgba(255, 107, 53, 0.1) 0%, rgba(255, 85, 33, 0.1) 100%); border-left: 4px solid #ff6b35;">
                                    <small style="color: #999; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">Ventas Turno</small>
                                    <h3 style="color: #ff6b35; margin-top: 12px; margin-bottom: 0; font-weight: 800;">+ <?= number_format($total_ventas, 2) ?></h3>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div style="padding: 20px; border-radius: 12px; background: linear-gradient(135deg, rgba(183, 28, 28, 0.1) 0%, rgba(139, 20, 20, 0.1) 100%); border-left: 4px solid #b71c1c;">
                                    <small style="color: #999; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">Gastos Turno</small>
                                    <h3 style="color: #b71c1c; margin-top: 12px; margin-bottom: 0; font-weight: 800;">- <?= number_format($total_gastos, 2) ?></h3>
                                </div>
                            </div>
                        </div>

                        <!-- Esperado vs Real -->
                        <div style="background: linear-gradient(135deg, #f5f5f5 0%, #ffffff 100%); padding: 30px; border-radius: 12px; margin-bottom: 40px; border-left: 4px solid #DC2626;">
                            <div style="text-align: center; margin-bottom: 20px;">
                                <small style="color: #999; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">Dinero Esperado en Cajón</small>
                                <h1 style="font-size: 42px; font-weight: 800; color: #22C55E; margin: 12px 0 0 0;">
                                    <?= $config['moneda'] . number_format($saldo_esperado, 2) ?>
                                </h1>
                                <p style="color: #999; font-size: 12px; margin-top: 8px; margin-bottom: 0;">
                                    Base Inicial + Ventas - Gastos
                                </p>
                            </div>
                        </div>

                        <hr style="border: none; height: 1px; background: linear-gradient(to right, transparent, #ddd, transparent); margin: 40px 0;">

                        <!-- Formulario de Conteo -->
                        <form action="/caja/cerrar" method="POST" class="needs-validation" id="formCierreCaja">
                            
                            <input type="hidden" name="caja_id" value="<?= $cajaAbierta['id'] ?>">
                            <input type="hidden" name="total_ventas" value="<?= $total_ventas ?>">
                            <input type="hidden" name="total_gastos" value="<?= $total_gastos ?>">
                            <input type="hidden" name="saldo_esperado" value="<?= $saldo_esperado ?>">

                            <div class="mb-5 text-center">
                                <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px; display: block; margin-bottom: 20px;">
                                    <i class="fas fa-search-dollar"></i> Ingrese el Monto Contado Físicamente
                                </label>
                                <div style="display: flex; justify-content: center;">
                                    <div style="width: 100%; max-width: 400px;">
                                        <div style="display: flex; height: 60px;">
                                            <span style="background: linear-gradient(135deg, #d4af37 0%, #b8941f 100%); color: white; padding: 0 20px; display: flex; align-items: center; font-weight: 700; font-size: 18px; border-radius: 10px 0 0 10px; border: none;">
                                                CONTEO: <?= $config['moneda'] ?>
                                            </span>
                                            <input 
                                                type="number" 
                                                step="0.01" 
                                                name="monto_fisico" 
                                                style="flex: 1; font-size: 20px; font-weight: 700; text-align: center; border: 2px solid #22C55E; border-left: none; border-radius: 0 10px 10px 0; padding: 0 20px;"
                                                placeholder="0.00" 
                                                required 
                                                autofocus
                                            >
                                        </div>
                                        <p style="color: #999; font-size: 12px; margin-top: 12px; margin-bottom: 0;">
                                            Cuente los billetes y monedas del cajón e ingrese el total exacto
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div style="display: grid; gap: 12px;">
                                <button type="submit" style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%); color: white; font-weight: 700; padding: 18px; border-radius: 10px; border: none; text-transform: uppercase; letter-spacing: 1px; font-size: 14px; cursor: pointer;">
                                    <i class="fas fa-lock"></i> CONFIRMAR Y CERRAR CAJA
                                </button>
                                <a href="/home/index" style="background: white; color: #666; padding: 12px; border-radius: 10px; text-align: center; text-decoration: none; font-weight: 600; border: 2px solid #e0e0e0; transition: all 0.3s ease;">
                                    <i class="fas fa-arrow-left"></i> Volver al Dashboard
                                </a>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require_once '../app/views/inc/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formCierre = document.getElementById('formCierreCaja');
            
            formCierre.addEventListener('submit', function(e) {
                e.preventDefault(); // Detiene el envío automático del formulario

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Confirma que has contado el dinero correctamente. Se procederá a cerrar el turno y esta acción no se puede deshacer.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545', // Color rojo peligro (coincide con el botón)
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, cerrar turno',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true // Pone el botón de cancelar a la izquierda
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si el usuario confirma, enviamos el formulario programáticamente
                        this.submit();
                    }
                });
            });
        });
    </script>
</body>
</html>