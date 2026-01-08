<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Suscripción - <?= $config['nombre_sistema'] ?? 'Gym' ?></title>
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
                    <!-- Premium Header - Orange -->
                    <div style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%); padding: 40px 30px; text-align: center; color: white;">
                        <i class="fas fa-file-invoice-dollar" style="font-size: 40px; display: block; margin-bottom: 15px;"></i>
                        <h2 style="margin: 0 0 8px; font-weight: 800; font-size: 28px;">Nueva Suscripción</h2>
                        <p style="margin: 0; opacity: 0.9; font-size: 14px;">Registre una nueva membresía</p>
                    </div>

                    <div class="card-body p-5">
                        <form action="/suscripciones/guardar" method="POST">
                            
                            <!-- Seleccionar Socio -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                    <i class="fas fa-user"></i> Seleccionar Socio
                                </label>
                                <select 
                                    class="form-select" 
                                    name="socio_id" 
                                    style="padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px;"
                                    required>
                                    <option value="">-- Elige un socio --</option>
                                    <?php foreach($socios as $socio): ?>
                                        <?php if($socio['estado'] == 'activo'): ?>
                                            <option value="<?= $socio['id'] ?>">
                                                <?= $socio['nombre'] ?> (DNI: <?= $socio['dni'] ?>)
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Seleccionar Plan -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                    <i class="fas fa-layer-group"></i> Seleccionar Plan
                                </label>
                                <select 
                                    class="form-select" 
                                    name="plan_id" 
                                    style="padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px;"
                                    required>
                                    <option value="">-- Elige un plan --</option>
                                    <?php foreach($planes as $plan): ?>
                                        <?php if($plan['estado'] == 'activo'): ?>
                                            <option value="<?= $plan['id'] ?>">
                                                <?= $plan['nombre'] ?> - <?= $config['moneda'] ?><?= $plan['precio'] ?> (<?= $plan['duracion_dias'] ?> días)
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Fecha de Inicio -->
                            <div class="mb-5">
                                <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                    <i class="fas fa-calendar"></i> Fecha de Inicio
                                </label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    name="fecha_inicio" 
                                    style="padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px;"
                                    value="<?= date('Y-m-d') ?>" 
                                    required>
                                <small style="color: #999; display: block; margin-top: 8px;">
                                    <i class="fas fa-info-circle"></i> La fecha de fin se calculará automáticamente según el plan.
                                </small>
                            </div>

                            <!-- Botones -->
                            <div style="display: grid; gap: 12px;">
                                <button 
                                    type="submit" 
                                    style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%); color: white; font-weight: 700; padding: 14px; border-radius: 8px; border: none; text-transform: uppercase; letter-spacing: 1px; font-size: 14px; cursor: pointer;"
                                >
                                    <i class="fas fa-check-circle"></i> REGISTRAR SUSCRIPCIÓN
                                </button>
                                <a 
                                    href="/suscripciones/index" 
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>