<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes - <?= $config['nombre_sistema'] ?? 'Gym' ?></title>
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
                    <h1 class="mb-2"><i class="fas fa-dumbbell" style="color: #b71c1c;"></i> Planes de Membresía</h1>
                    <p class="text-muted">Gestiona los planes de suscripción disponibles</p>
                </div>
                <a href="/planes/crear" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nuevo Plan
                </a>
            </div>
        </div>

        <div class="card border-0 shadow">
            <div class="card-body p-0">
                <div class="table-responsive">
                <table class="table table-hover align-middle table-data mb-0">
                    <thead style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%); color: white;">
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Duración (Días)</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($planes as $plan): ?>
                        <tr>
                            <td>
                                <strong style="color: #b71c1c;"><?= $plan['nombre'] ?></strong>
                            </td>
                            <td>
                                <span class="badge" style="background: linear-gradient(135deg, #d4af37 0%, #b8941f 100%);">
                                    <?= $config['moneda'] ?> <?= number_format($plan['precio'], 2) ?>
                                </span>
                            </td>
                            <td><?= $plan['duracion_dias'] ?> días</td>
                            <td><small><?= $plan['descripcion'] ?></small></td>
                            <td>
                                <?php if($plan['estado'] == 'activo'): ?>
                                    <span class="badge" style="background: linear-gradient(135deg, #ff6b35 0%, #ff5521 100%);">Activo</span>
                                <?php else: ?>
                                    <span class="badge" style="background: linear-gradient(135deg, #b71c1c 0%, #8b1414 100%);">Inactivo</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="/planes/editar/<?= $plan['id'] ?>" class="btn btn-sm" style="background: linear-gradient(135deg, #ff6b35 0%, #ff5521 100%); color: white; border: none;">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <?php if($plan['estado'] == 'activo'): ?>
                                    <a href="/planes/cambiarEstado/<?= $plan['id'] ?>/inactivo" 
                                       class="btn btn-sm btn-confirm"
                                       style="background: linear-gradient(135deg, #b71c1c 0%, #8b1414 100%); color: white; border: none;"
                                       data-title="¿Desactivar este plan?">
                                        <i class="fas fa-ban"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="/planes/cambiarEstado/<?= $plan['id'] ?>/activo" 
                                       class="btn btn-sm btn-confirm"
                                       style="background: linear-gradient(135deg, #1a8917 0%, #135a0e 100%); color: white; border: none;"
                                       data-title="¿Reactivar este plan?">
                                        <i class="fas fa-check"></i>
                                    </a>
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