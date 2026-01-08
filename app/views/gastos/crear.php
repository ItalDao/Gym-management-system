<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Gasto - <?= $config['nombre_sistema'] ?? 'Gym' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body class="bg-light">
    <?php require_once '../app/views/inc/navbar.php'; ?>
    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow">
                    <!-- Premium Header - Red -->
                    <div style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%); padding: 40px 30px; text-align: center; color: white;">
                        <i class="fas fa-receipt" style="font-size: 40px; display: block; margin-bottom: 15px;"></i>
                        <h2 style="margin: 0 0 8px; font-weight: 800; font-size: 28px;">Registrar Gasto</h2>
                        <p style="margin: 0; opacity: 0.9; font-size: 14px;">Agregue un nuevo gasto operativo</p>
                    </div>

                    <div class="card-body p-5">
                        <form action="/gastos/guardar" method="POST">
                            <!-- Descripción -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                    <i class="fas fa-pen"></i> Descripción del Gasto
                                </label>
                                <input 
                                    type="text" 
                                    name="descripcion" 
                                    class="form-control" 
                                    style="padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px;"
                                    placeholder="Ej: Recibo de Luz, Pago Limpieza, Mantenimiento..." 
                                    required
                                    autofocus>
                            </div>

                            <!-- Monto -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                    <i class="fas fa-coins"></i> Monto
                                </label>
                                <div class="input-group" style="height: 50px;">
                                    <span class="input-group-text" style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%); color: white; font-weight: 700; border: none;">
                                        <?= $config['moneda'] ?>
                                    </span>
                                    <input 
                                        type="number" 
                                        step="0.01" 
                                        name="monto" 
                                        class="form-control" 
                                        style="border: 2px solid #F97316; font-weight: 700; font-size: 16px;"
                                        placeholder="0.00" 
                                        required>
                                </div>
                            </div>

                            <!-- Fecha -->
                            <div class="mb-5">
                                <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                    <i class="fas fa-calendar"></i> Fecha
                                </label>
                                <input 
                                    type="date" 
                                    name="fecha" 
                                    class="form-control" 
                                    style="padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px;"
                                    value="<?= date('Y-m-d') ?>" 
                                    required>
                            </div>

                            <!-- Botones -->
                            <div style="display: grid; gap: 12px;">
                                <button 
                                    type="submit" 
                                    style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%); color: white; font-weight: 700; padding: 14px; border-radius: 8px; border: none; text-transform: uppercase; letter-spacing: 1px; font-size: 14px; cursor: pointer;"
                                >
                                    <i class="fas fa-save"></i> GUARDAR GASTO
                                </button>
                                <a 
                                    href="/gastos/index" 
                                    style="background: white; color: #666; padding: 12px; border-radius: 8px; text-align: center; text-decoration: none; font-weight: 600; border: 2px solid #e0e0e0; transition: all 0.3s ease;"
                                >
                                    <i class="fas fa-arrow-left"></i> Cancelar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once '../app/views/inc/footer.php'; ?>
</body>
</html>