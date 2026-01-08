<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración - <?= $config['nombre_sistema'] ?? 'Gym' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body class="bg-light">

    <?php require_once '../app/views/inc/navbar.php'; ?>

    <div class="container mt-4 mb-5">
        <!-- Encabezado -->
        <div class="mb-4">
            <div>
                <h1 class="mb-2"><i class="fas fa-cogs" style="color: #DC2626;"></i> Configuración del Sistema</h1>
                <p class="text-muted">Administra los datos de tu empresa</p>
            </div>
        </div>

        <?php if(isset($_GET['msg'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-left: 4px solid #DC2626; background: linear-gradient(135deg, rgba(220, 38, 38, 0.1) 0%, rgba(249, 115, 22, 0.1) 100%);">
                <i class="fas fa-check-circle" style="color: #DC2626;"></i> 
                <strong>¡Excelente!</strong> Configuración actualizada correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card border-0 shadow">
                    <!-- Header Premium -->
                    <div style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%); color: white; padding: 40px 30px;">
                        <h3 style="margin: 0; font-weight: 700; display: flex; align-items: center; gap: 12px;">
                            <i class="fas fa-building"></i> Datos de la Empresa
                        </h3>
                    </div>

                    <div class="card-body p-4">
                        <form action="/configuracion/actualizar" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="logo_actual" value="<?= $datos['logo'] ?>">

                            <!-- Logo Section -->
                            <div class="row mb-5 align-items-center">
                                <div class="col-md-4">
                                    <label class="fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">Logo Actual</label>
                                    <div class="p-4 rounded" style="background: linear-gradient(135deg, #f5f5f5 0%, #fafafa 100%); text-align: center; border: 2px dashed #e0e0e0; transition: all 0.3s ease;">
                                        <?php if(!empty($datos['logo'])): ?>
                                            <img src="/img/<?= $datos['logo'] ?>?v=<?= time() ?>" class="img-fluid" style="max-height: 120px; border-radius: 8px;">
                                        <?php else: ?>
                                            <i class="fas fa-image" style="font-size: 48px; color: #ddd; display: block; margin-bottom: 10px;"></i>
                                            <p class="text-muted small">Sin Logo</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                        <i class="fas fa-upload"></i> Subir Nuevo Logo
                                    </label>
                                    <input type="file" class="form-control" name="logo" accept="image/*" style="border: 2px solid #e0e0e0; padding: 12px 16px;">
                                    <small class="text-muted d-block mt-2">Formatos: PNG, JPG (máximo 2MB)</small>
                                </div>
                            </div>

                            <hr style="border-color: #e0e0e0; margin: 30px 0;">

                            <!-- Datos Principales -->
                            <div class="row">
                                <div class="col-md-8 mb-4">
                                    <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                        <i class="fas fa-store"></i> Nombre del Gimnasio
                                    </label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="nombre" 
                                        value="<?= $datos['nombre_sistema'] ?>" 
                                        style="border: 2px solid #e0e0e0; padding: 12px 16px; border-radius: 8px;"
                                        required
                                    >
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px; color: #DC2626 !important;">
                                        <i class="fas fa-dollar-sign"></i> Símbolo Moneda
                                    </label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="moneda" 
                                        value="<?= $datos['moneda'] ?>" 
                                        placeholder="Ej: $, S/, €"
                                        style="border: 2px solid #DC2626; padding: 12px 16px; border-radius: 8px;"
                                        required
                                    >
                                </div>
                            </div>

                            <!-- Datos Legales -->
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                        <i class="fas fa-id-card"></i> RUC / NIT
                                    </label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="ruc" 
                                        value="<?= $datos['ruc'] ?>"
                                        style="border: 2px solid #e0e0e0; padding: 12px 16px; border-radius: 8px;"
                                        required
                                    >
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                        <i class="fas fa-phone"></i> Teléfono
                                    </label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="telefono" 
                                        value="<?= $datos['telefono'] ?>"
                                        style="border: 2px solid #e0e0e0; padding: 12px 16px; border-radius: 8px;"
                                    >
                                </div>
                            </div>

                            <!-- Contacto -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                    <i class="fas fa-map-marker-alt"></i> Dirección
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="direccion" 
                                    value="<?= $datos['direccion'] ?>"
                                    style="border: 2px solid #e0e0e0; padding: 12px 16px; border-radius: 8px;"
                                >
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                    <i class="fas fa-envelope"></i> Email de Contacto
                                </label>
                                <input 
                                    type="email" 
                                    class="form-control" 
                                    name="email" 
                                    value="<?= $datos['email'] ?>"
                                    style="border: 2px solid #e0e0e0; padding: 12px 16px; border-radius: 8px;"
                                >
                            </div>

                            <!-- Botón -->
                            <div class="pt-3">
                                <button type="submit" class="btn" style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%); color: white; font-weight: 700; padding: 14px 32px; border-radius: 8px; width: 100%; border: none; text-transform: uppercase; letter-spacing: 1px;">
                                    <i class="fas fa-save"></i> Guardar Cambios
                                </button>
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