<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caja - <?= $config['nombre_sistema'] ?? 'Gym' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body class="bg-light">

    <?php require_once '../app/views/inc/navbar.php'; ?>

    <div class="container mt-4 mb-5">
        
        <?php if(isset($_GET['msg']) && $_GET['msg']=='cerrado'): ?>
            <div class="alert alert-dismissible fade show mb-4" role="alert" style="background: linear-gradient(135deg, rgba(220, 38, 38, 0.1) 0%, rgba(249, 115, 22, 0.1) 100%); border-left: 4px solid #DC2626;">
                <h4 style="color: #DC2626; margin: 0 0 8px 0;">
                    <i class="fas fa-check-circle"></i> ¡Turno Cerrado Correctamente!
                </h4>
                <p style="color: #558b2f; margin: 0;">La caja está lista para una nueva apertura.</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Apertura de Caja -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-5">
                <div class="card border-0 shadow" style="transition: all 0.3s ease;">
                    <!-- Header Premium -->
                    <div style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); padding: 40px 30px; text-align: center; color: white;">
                        <i class="fas fa-cash-register" style="font-size: 48px; display: block; margin-bottom: 15px; opacity: 0.9;"></i>
                        <h2 style="margin: 0 0 8px; font-weight: 800; font-size: 28px;">Apertura de Caja</h2>
                        <p style="margin: 0; opacity: 0.9; font-size: 14px;">Ingrese el monto inicial para comenzar</p>
                    </div>

                    <div class="card-body p-5">
                        <form action="/caja/abrir" method="POST">
                            <div class="mb-4">
                                <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                    <i class="fas fa-coins"></i> Monto Inicial
                                </label>
                                <div class="input-group" style="height: 50px;">
                                    <span class="input-group-text" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white; font-weight: 700; border: none; font-size: 18px;">
                                        <?= $config['moneda'] ?>
                                    </span>
                                    <input 
                                        type="number" 
                                        step="0.01" 
                                        name="monto_inicial" 
                                        class="form-control" 
                                        placeholder="0.00" 
                                        style="font-weight: 700; font-size: 18px; border: 2px solid #10B981;"
                                        required 
                                        autofocus
                                    >
                                </div>
                            </div>
                            <button type="submit" class="btn w-100" style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%); color: white; font-weight: 700; padding: 14px; border-radius: 8px; border: none; text-transform: uppercase; letter-spacing: 1px; font-size: 14px;">
                                <i class="fas fa-play-circle"></i> INICIAR TURNO
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Historial -->
        <div class="card border-0 shadow">
            <div class="card-body p-0">
                <div style="background: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 100%); color: #1F2937; padding: 30px; display: flex; align-items: center; gap: 15px;">
                    <i class="fas fa-history" style="font-size: 28px;"></i>
                    <h3 style="margin: 0; font-weight: 700;">Historial de Cierres Recientes</h3>
                </div>
                <div class="table-responsive">
                <table class="table table-hover align-middle table-data mb-0">
                    <thead style="background: linear-gradient(135deg, #f5f5f5 0%, #ffffff 100%);">
                        <tr>
                            <th>Fecha Cierre</th>
                            <th>Cajero</th>
                            <th style="color: #10B981;">Inicial</th>
                            <th style="color: #10B981;">Ventas</th>
                            <th style="color: #10B981;">Gastos</th>
                            <th style="color: #1a1a1a;">Esperado</th>
                            <th style="color: #1a1a1a;">Real</th>
                            <th style="color: #1a1a1a;">Cuadre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($historial as $h): ?>
                            <?php if($h['estado'] == 'cerrada'): ?>
                            <tr>
                                <td><small class="text-muted"><?= date('d/m/Y H:i', strtotime($h['fecha_cierre'])) ?></small></td>
                                <td><strong><?= $h['cajero'] ?></strong></td>
                                <td>
                                    <span class="badge" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                                        <?= $config['moneda'] . number_format($h['monto_inicial'], 2) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                                        +<?= number_format($h['total_ventas'], 2) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge" style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%);">
                                        -<?= number_format($h['total_gastos'], 2) ?>
                                    </span>
                                </td>
                                
                                <?php $sistema = $h['monto_inicial'] + $h['total_ventas'] - $h['total_gastos']; ?>
                                <td style="font-weight: 700; background: #f8f8f8;">
                                    <?= $config['moneda'] . number_format($sistema, 2) ?>
                                </td>
                                
                                <td style="font-weight: 700;">
                                    <?= $config['moneda'] . number_format($h['monto_final'], 2) ?>
                                </td>
                                
                                <td>
                                    <?php if($h['diferencia'] == 0): ?>
                                        <span class="badge" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                                            <i class="fas fa-check-circle"></i> OK
                                        </span>
                                    <?php elseif($h['diferencia'] < 0): ?>
                                        <span class="badge" style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%);">
                                            <i class="fas fa-minus-circle"></i> Falta
                                        </span>
                                    <?php else: ?>
                                        <span class="badge" style="background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%);">
                                            <i class="fas fa-plus-circle"></i> Sobra
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endif; ?>
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