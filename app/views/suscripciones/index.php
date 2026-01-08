<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suscripciones - <?= $config['nombre_sistema'] ?? 'Gym' ?></title>
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
                    <h1 class="mb-2"><i class="fas fa-file-invoice-dollar" style="color: #DC2626;"></i> Suscripciones Activas</h1>
                    <p class="text-muted">Control de membresías activas y renovaciones</p>
                </div>
                <div>
                    <a href="/suscripciones/exportarExcel" class="btn btn-success me-2">
                        <i class="fas fa-file-excel"></i> Exportar Excel
                    </a>
                    <a href="/suscripciones/crear" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nueva Venta
                    </a>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow">
            <div class="card-body p-0">
                <div class="table-responsive">
                <table class="table table-hover align-middle table-data mb-0">
                    <thead style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%); color: white;">
                        <tr>
                            <th>ID</th>
                            <th>Socio</th>
                            <th>Plan (Precio)</th>
                            <th>Inicio</th>
                            <th>Vencimiento</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($suscripciones)): ?>
                             <?php else: ?>
                            <?php foreach ($suscripciones as $sub): ?>
                            <?php 
                                $hoy = date('Y-m-d');
                                $vencida = ($hoy > $sub['fecha_fin'] || $sub['estado'] == 'vencida');
                            ?>
                            <tr class="<?= $vencida ? 'table-danger' : '' ?>">
                                <td><small class="text-muted">#<?= $sub['id'] ?></small></td>
                                <td>
                                    <strong style="color: #10B981;"><?= $sub['nombre_socio'] ?></strong>
                                </td>
                                <td>
                                    <?= $sub['nombre_plan'] ?><br>
                                    <span class="badge" style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%);">
                                        <?= $config['moneda'] ?><?= $sub['precio'] ?>
                                    </span>
                                </td>
                                <td><?= date('d/m/Y', strtotime($sub['fecha_inicio'])) ?></td>
                                <td>
                                    <strong><?= date('d/m/Y', strtotime($sub['fecha_fin'])) ?></strong>
                                </td>
                                <td>
                                    <?php if($vencida): ?>
                                        <span class="badge" style="background: linear-gradient(135deg, #7F1D1D 0%, #5F0f0f 100%);">Vencida</span>
                                    <?php else: ?>
                                        <span class="badge" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">Activa</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="/comprobante/generar/<?= $sub['id'] ?>" 
                                           target="_blank" 
                                           class="btn" 
                                           title="Imprimir PDF"
                                           style="background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%); color: white; border: none;">
                                            <i class="fas fa-print"></i>
                                        </a>

                                        <?php if(!$vencida): ?>
                                        <a href="/suscripciones/cancelar/<?= $sub['id'] ?>" 
                                           class="btn btn-confirm"
                                           data-title="¿Cancelar suscripción de <?= $sub['nombre_socio'] ?>?"
                                           title="Cancelar Suscripción"
                                           style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%); color: white; border: none;">
                                            <i class="fas fa-times-circle"></i>
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    
    <?php require_once '../app/views/inc/footer.php'; ?>
</body>
</html>