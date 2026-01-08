<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Plan - <?= $config['nombre_sistema'] ?? 'Gym' ?></title>
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
                    <div style="background: linear-gradient(135deg, #8B5CF6 0%, #6D28D9 100%); padding: 40px 30px; text-align: center; color: white;">
                        <i class="fas fa-layer-group" style="font-size: 40px; display: block; margin-bottom: 15px;"></i>
                        <h2 style="margin: 0 0 8px; font-weight: 800; font-size: 28px;">Crear Plan</h2>
                        <p style="margin: 0; opacity: 0.9; font-size: 14px;">Agregue un nuevo plan de membresía</p>
                    </div>

                    <div class="card-body p-5">
                        <form action="/planes/guardar" method="POST">
                            <!-- Nombre Plan -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                    <i class="fas fa-tag"></i> Nombre del Plan
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="nombre" 
                                    style="padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px;"
                                    placeholder="Ej: Plan Mensual VIP" 
                                    required
                                    autofocus>
                            </div>

                            <!-- Precio y Duración -->
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                        <i class="fas fa-coins"></i> Precio
                                    </label>
                                    <div class="input-group" style="height: 50px;">
                                        <span class="input-group-text" style="background: linear-gradient(135deg, #F97316 0%, #EA580C 100%); color: white; font-weight: 700; border: none;">
                                            <?= $config['moneda'] ?>
                                        </span>
                                        <input 
                                            type="number" 
                                            step="0.01" 
                                            class="form-control" 
                                            name="precio" 
                                            style="border: 2px solid #F97316; font-weight: 700;"
                                            placeholder="0.00" 
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                        <i class="fas fa-calendar-days"></i> Duración (Días)
                                    </label>
                                    <input 
                                        type="number" 
                                        class="form-control" 
                                        name="duracion" 
                                        style="padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px;"
                                        placeholder="Ej: 30" 
                                        required>
                                </div>
                            </div>

                            <!-- Descripción -->
                            <div class="mb-5">
                                <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                    <i class="fas fa-align-left"></i> Descripción
                                </label>
                                <textarea 
                                    class="form-control" 
                                    name="descripcion" 
                                    rows="3"
                                    style="padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px; resize: vertical;"
                                    placeholder="Ej: Acceso a todas las máquinas, sauna, piscina..."></textarea>
                            </div>

                            <!-- Botones -->
                            <div style="display: grid; gap: 12px;">
                                <button 
                                    type="submit" 
                                    style="background: linear-gradient(135deg, #8B5CF6 0%, #6D28D9 100%); color: white; font-weight: 700; padding: 14px; border-radius: 8px; border: none; text-transform: uppercase; letter-spacing: 1px; font-size: 14px; cursor: pointer;"
                                >
                                    <i class="fas fa-save"></i> GUARDAR PLAN
                                </button>
                                <a 
                                    href="/planes/index" 
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