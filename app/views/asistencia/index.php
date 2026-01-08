<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Acceso - <?= $config['nombre_sistema'] ?? 'Gym' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/css/styles.css">
    <style>
        .big-input { font-size: 2rem; text-align: center; letter-spacing: 5px; font-weight: bold; }
        .foto-validacion { 
            width: 220px; height: 220px; object-fit: cover; 
            border: 5px solid #3B82F6;
            box-shadow: 0 8px 20px rgba(0,0,0,0.25); 
        }
        .card-verificacion { transform: scale(1.02); transition: all 0.3s; }
        .btn-lg { padding: 15px 20px; font-size: 18px; font-weight: 600; }
    </style>
</head>
<body class="bg-light">

    <?php require_once '../app/views/inc/navbar.php'; ?>

    <div class="container mt-4">
        
        <?php if(!empty($mensaje_exito)): ?>
            <div class="alert alert-success text-center shadow fw-bold mb-4 border-0" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white; padding: 20px; border-radius: 12px; animation: slideDown 0.3s ease;">
                <i class="fas fa-check-circle" style="font-size: 24px; margin-right: 8px;"></i> <?= $mensaje_exito ?>
            </div>
            <style>
                @keyframes slideDown {
                    from { transform: translateY(-20px); opacity: 0; }
                    to { transform: translateY(0); opacity: 1; }
                }
            </style>
        <?php endif; ?>

        <?php if(!empty($error_busqueda)): ?>
            <div class="alert alert-danger text-center shadow fw-bold mb-4">
                <i class="fas fa-exclamation-circle"></i> <?= $error_busqueda ?>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <?php if(isset($perfil_validacion)): ?>
                    
                    <div class="card shadow-lg mb-4 border-0 card-verificacion">
                        <div class="card-header" style="background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%); color: white; padding: 20px;">
                            <h5 class="m-0 fw-bold text-center"><i class="fas fa-eye"></i> VERIFICACIÓN REQUERIDA</h5>
                        </div>
                        
                        <div class="card-body p-4 text-center bg-white">
                            
                            <?php if(!empty($perfil_validacion['foto'])): ?>
                                <img src="/img/socios/<?= $perfil_validacion['foto'] ?>" class="rounded-circle foto-validacion mb-3">
                            <?php else: ?>
                                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mx-auto foto-validacion mb-3">
                                    <i class="fas fa-user fa-6x"></i>
                                </div>
                            <?php endif; ?>

                            <h2 class="fw-bold display-6" style="color: #1a1a1a;"><?= $perfil_validacion['nombre'] ?></h2>
                            
                            <?php if($perfil_validacion['estado_socio'] != 'activo'): ?>
                                <div class="alert alert-danger mt-3 fw-bold">
                                    <i class="fas fa-ban"></i> ACCESO DENEGADO: SOCIO INACTIVO
                                </div>
                            
                            <?php elseif(!$perfil_validacion['tiene_acceso']): ?>
                                <div class="alert alert-danger mt-3 fw-bold">
                                    <i class="fas fa-exclamation-triangle"></i> MEMBRESÍA VENCIDA O NO EXISTENTE
                                </div>
                            
                            <?php else: ?>
                                <div class="alert alert-success mt-3">
                                    <i class="fas fa-check-circle"></i> <strong>PLAN ACTIVO</strong>
                                    <br>
                                    <small>Vence: <?= $perfil_validacion['fecha_vence'] ?> (<?= $perfil_validacion['dias_restantes'] ?> días)</small>
                                </div>
                            <?php endif; ?>

                            <hr>
                            <h5 class="text-muted mb-3">¿Es la persona de la foto?</h5>

                            <div class="row gx-2">
                                <div class="col-6">
                                    <a href="/asistencia/index" class="btn btn-outline-secondary btn-lg w-100 py-3">
                                        <i class="fas fa-times"></i> RECHAZAR
                                    </a>
                                </div>
                                <div class="col-6">
                                    <?php if($perfil_validacion['tiene_acceso'] && $perfil_validacion['estado_socio'] == 'activo'): ?>
                                        <form action="/asistencia/registrar" method="POST">
                                            <input type="hidden" name="socio_id" value="<?= $perfil_validacion['id'] ?>">
                                            <button type="submit" class="btn btn-lg w-100 py-3 fw-bold shadow" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white; border: none;">
                                                <i class="fas fa-check"></i> CONFIRMAR
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <button class="btn btn-lg w-100 py-3 disabled" disabled style="background-color: #9CA3AF; color: white;">
                                            <i class="fas fa-lock"></i> NO HABILITADO
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                    </div>

                <?php else: ?>

                    <div class="card shadow-lg mb-4 border-0">
                        <div class="card-header" style="background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%); color: white; padding: 20px; border-bottom: 2px solid #1E40AF;">
                            <h3 class="m-0 text-center"><i class="fas fa-id-card-alt"></i> Control de Acceso</h3>
                        </div>
                        <div class="card-body p-5 text-center">
                            <div class="mb-4">
                                <i class="fas fa-dumbbell fa-4x" style="color: #DC2626; opacity: 0.3;"></i>
                                <h5 class="text-muted mt-3">Escanea tu DNI para ingresar</h5>
                            </div>

                            <form action="/asistencia/validar" method="POST">
                                <input type="text" name="dni" class="form-control big-input" 
                                       placeholder="DNI..." autocomplete="off" autofocus required
                                       style="border: 2px solid #3B82F6;">
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-lg" style="background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%); color: white; border: none; font-weight: 600;">
                                        <i class="fas fa-search"></i> BUSCAR SOCIO
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                <?php endif; ?>

            </div>
        </div>

        <div class="card shadow border-0 mt-3">
            <div class="card-header">
                <h5 class="m-0"><i class="fas fa-history" style="color: #DC2626;"></i> Ingresos Confirmados Hoy</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-data mb-0 align-middle">
                        <thead style="background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%); color: white;">
                            <tr>
                                <th>Hora</th>
                                <th>Socio</th>
                                <th>DNI</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                // Debug: Mostrar cantidad de registros
                                // echo "<!-- Historial count: " . count($historial) . " -->";
                                foreach($historial as $h): 
                            ?>
                                <tr>
                                    <td class="fw-bold" style="color: #10B981;"><?= date('H:i:s', strtotime($h['fecha_hora'])) ?></td>
                                    <td><?= $h['nombre'] ?></td>
                                    <td><code><?= $h['dni'] ?></code></td>
                                    <td><span class="badge" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">Ingresó</span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <?php require_once '../app/views/inc/footer.php'; ?>
</body>
</html>