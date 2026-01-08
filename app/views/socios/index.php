<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Socios - <?= $config['nombre_sistema'] ?? 'Gym' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body class="bg-light">

    <?php require_once '../app/views/inc/navbar.php'; ?>

    <div class="container mt-4 mb-5">
        <!-- Encabezado -->
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2"><i class="fas fa-users text-primary"></i> Directorio de Socios</h1>
                    <p class="text-muted">Gestión completa de miembros del gimnasio</p>
                </div>
                <?php if($_SESSION['user_rol'] != 'entrenador'): ?>
                    <a href="/socios/crear" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nuevo Socio
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Tarjeta Principal -->
        <div class="card border-0 shadow">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-data mb-0">
                        <thead>
                            <tr>
                                <th style="width: 60px;">Foto</th>
                                <th>Nombre</th>
                                <th>DNI</th>
                                <th>Email</th>
                                <th style="width: 100px;">Estado</th>
                                <th style="width: 200px;" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($socios as $socio): ?>
                            <tr>
                                <td>
                                    <?php if(!empty($socio['foto'])): ?>
                                        <img src="/img/socios/<?= $socio['foto'] ?>?v=<?= time() ?>" 
                                             alt="Foto" 
                                             class="rounded-circle border-2"
                                             width="45" height="45" 
                                             style="object-fit: cover; border-color: #667eea;">
                                    <?php else: ?>
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" 
                                             style="width: 45px; height: 45px; font-weight: 600;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <strong><?= $socio['nombre'] ?></strong>
                                </td>
                                
                                <td>
                                    <code><?= $socio['dni'] ?></code>
                                </td>
                                
                                <td>
                                    <small><?= $socio['email'] ?></small>
                                </td>
                                
                                <td>
                                    <?php if($socio['estado'] == 'activo'): ?>
                                        <span class="badge bg-success"><i class="fas fa-check-circle"></i> Activo</span>
                                    <?php elseif($socio['estado'] == 'inactivo'): ?>
                                        <span class="badge bg-danger"><i class="fas fa-circle-xmark"></i> Inactivo</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark"><i class="fas fa-clock"></i> Pendiente</span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <?php if($_SESSION['user_rol'] != 'entrenador'): ?>
                                            <a href="/carnet/generar/<?= $socio['id'] ?>" 
                                               target="_blank" 
                                               class="btn btn-outline-info" 
                                               title="Carnet Digital">
                                                <i class="fas fa-id-card"></i>
                                            </a>
                                        <?php endif; ?>

                                        <a href="/progreso/ver/<?= $socio['id'] ?>" 
                                           class="btn btn-outline-secondary" 
                                           title="Ver Progreso">
                                            <i class="fas fa-chart-line"></i>
                                        </a>

                                        <?php if($_SESSION['user_rol'] != 'entrenador'): ?>
                                            <a href="/socios/editar/<?= $socio['id'] ?>" 
                                               class="btn btn-outline-warning" 
                                               title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if(isset($_SESSION['user_rol']) && $_SESSION['user_rol'] == 'admin'): ?>
                                            <?php if($socio['estado'] != 'inactivo'): ?>
                                                <a href="/socios/cambiarEstado/<?= $socio['id'] ?>/inactivo" 
                                                   class="btn btn-outline-danger btn-confirm" 
                                                   data-title="¿Desactivar a <?= $socio['nombre'] ?>?">
                                                    <i class="fas fa-ban"></i>
                                                </a>
                                            <?php else: ?>
                                                <a href="/socios/cambiarEstado/<?= $socio['id'] ?>/activo" 
                                                   class="btn btn-outline-success btn-confirm" 
                                                   data-title="¿Reactivar a <?= $socio['nombre'] ?>?">
                                                    <i class="fas fa-redo"></i>
                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .btn-group-sm > .btn {
            padding: 6px 10px;
            font-size: 12px;
        }

        .table > :not(caption) > * > * {
            vertical-align: middle;
        }
    </style>

    <?php require_once '../app/views/inc/footer.php'; ?>
</body>
</html>