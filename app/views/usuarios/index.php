<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios - <?= $config['nombre_sistema'] ?? 'Gym' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body class="bg-light">

    <?php require_once '../app/views/inc/navbar.php'; ?>

    <div class="container mt-4 mb-5">
        <!-- Encabezado -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2"><i class="fas fa-user-shield" style="color: #3B82F6;"></i> Gestión de Usuarios</h1>
                    <p class="text-muted">Control de accesos y permisos del sistema</p>
                </div>
                <a href="/usuarios/crear" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nuevo Usuario
                </a>
            </div>
        </div>

        <div class="card border-0 shadow">
            <div class="card-body p-0">
                <div class="table-responsive">
                <table class="table table-hover align-middle table-data mb-0">
                    <thead style="background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%); color: white;">
                        <tr>
                            <th style="width: 8%;">ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th style="width: 12%;">Rol</th>
                            <th style="width: 10%;">Estado</th>
                            <th style="width: 12%;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td><small class="text-muted">#<?= $u['id'] ?></small></td>
                            <td>
                                <strong style="color: #3B82F6;"><?= $u['nombre'] ?></strong>
                            </td>
                            <td><small><?= $u['email'] ?></small></td>
                            <td>
                                <?php 
                                    $rolColor = '#3B82F6';
                                    $rolIcon = 'fa-user';
                                    if($u['rol'] == 'admin') { 
                                        $rolColor = '#DC2626'; 
                                        $rolIcon = 'fa-crown';
                                    }
                                    if($u['rol'] == 'recepcionista') { 
                                        $rolColor = '#10B981'; 
                                        $rolIcon = 'fa-headset';
                                    }
                                    if($u['rol'] == 'entrenador') { 
                                        $rolColor = '#3B82F6'; 
                                        $rolIcon = 'fa-dumbbell';
                                    }
                                ?>
                                <span class="badge" style="background: <?= $rolColor ?>; color: white;">
                                    <i class="fas <?= $rolIcon ?>"></i> <?= strtoupper($u['rol']) ?>
                                </span>
                            </td>
                            <td>
                                <?php if($u['estado'] == 'activo'): ?>
                                    <span class="badge" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                                        <i class="fas fa-check-circle"></i> Activo
                                    </span>
                                <?php else: ?>
                                    <span class="badge" style="background: linear-gradient(135deg, #9CA3AF 0%, #6B7280 100%);">
                                        <i class="fas fa-times-circle"></i> Inactivo
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="/usuarios/editar/<?= $u['id'] ?>" class="btn btn-sm" style="background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%); color: white; border: none;" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <?php if($u['id'] != $_SESSION['user_id']): ?>
                                    
                                    <?php if($u['estado'] == 'activo'): ?>
                                        <a href="/usuarios/cambiarEstado/<?= $u['id'] ?>/inactivo" 
                                           class="btn btn-sm btn-confirm"
                                           style="background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%); color: white; border: none;"
                                           data-title="¿Bloquear acceso a <?= $u['nombre'] ?>?"
                                           title="Desactivar">
                                            <i class="fas fa-ban"></i>
                                        </a>
                                    <?php else: ?>
                                        <a href="/usuarios/cambiarEstado/<?= $u['id'] ?>/activo" 
                                           class="btn btn-sm btn-confirm"
                                           style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%); color: white; border: none;"
                                           data-title="¿Reactivar acceso a <?= $u['nombre'] ?>?"
                                           title="Activar">
                                            <i class="fas fa-check"></i>
                                        </a>
                                    <?php endif; ?>

                                <?php endif; ?>
                            </td>
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