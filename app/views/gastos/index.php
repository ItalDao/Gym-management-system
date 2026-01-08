<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gastos - <?= $config['nombre_sistema'] ?? 'Gym' ?></title>
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
                    <h1 class="mb-2"><i class="fas fa-money-bill-wave" style="color: #F97316;"></i> Registro de Gastos</h1>
                    <p class="text-muted">Administra los gastos operativos del gymnasio</p>
                </div>
                <a href="/gastos/crear" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nuevo Gasto
                </a>
            </div>
        </div>

        <div class="card border-0 shadow">
            <div class="card-body p-0">
                <div class="table-responsive">
                <table class="table table-hover align-middle table-data mb-0">
                    <thead style="background: linear-gradient(135deg, #F97316 0%, #DC2626 100%); color: white;">
                        <tr>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Monto</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($gastos as $g): ?>
                        <tr>
                            <td>
                                <small class="text-muted"><?= date('d/m/Y', strtotime($g['fecha'])) ?></small>
                            </td>
                            <td>
                                <strong><?= $g['descripcion'] ?></strong>
                            </td>
                            <td>
                                <span class="badge" style="background: linear-gradient(135deg, #F97316 0%, #DC2626 100%);">
                                    -<?= $config['moneda'] ?> <?= number_format($g['monto'], 2) ?>
                                </span>
                            </td>
                            <td>
                                <a href="/gastos/eliminar/<?= $g['id'] ?>" 
                                   class="btn btn-sm btn-confirm"
                                   style="background: linear-gradient(135deg, #F97316 0%, #EA580C 100%); color: white; border: none;"
                                   data-title="¿Eliminar este gasto?">
                                    <i class="fas fa-trash"></i>
                                </a>
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