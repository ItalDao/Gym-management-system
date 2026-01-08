<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?= $config['nombre_sistema'] ?? 'Gym' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">

    <?php require_once '../app/views/inc/navbar.php'; ?>

    <div class="container pb-5 mt-4">
        
        <?php if(isset($_SESSION['user_rol']) && $_SESSION['user_rol'] == 'admin'): ?>
            
            <!-- Encabezado Dashboard -->
            <div class="mb-5">
                <h1 class="mb-2"><i class="fas fa-tachometer-alt text-primary"></i> Panel de Control</h1>
                <p class="text-muted">Resumen de tu negocio • <?= date('d \\d\\e F \\d\\e Y') ?></p>
            </div>

            <!-- KPI Cards -->
            <div class="row mb-5">
                <div class="col-md-6 col-lg-3">
                    <div class="card kpi-card primary h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="text-uppercase">Socios Activos</h6>
                                <div class="numero"><?= $totalSocios ?></div>
                            </div>
                            <div style="font-size: 40px; opacity: 0.2;">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card kpi-card success h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="text-uppercase">Ingresos Mes</h6>
                                <div class="numero"><?= number_format($ingresosMes, 0) ?></div>
                                <small><?= $config['moneda'] ?></small>
                            </div>
                            <div style="font-size: 40px; opacity: 0.2;">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card kpi-card danger h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="text-uppercase">Gastos Mes</h6>
                                <div class="numero"><?= number_format($gastosMes, 0) ?></div>
                                <small><?= $config['moneda'] ?></small>
                            </div>
                            <div style="font-size: 40px; opacity: 0.2;">
                                <i class="fas fa-credit-card"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card kpi-card warning h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="text-uppercase">Utilidad Neta</h6>
                                <div class="numero"><?= number_format($utilidad, 0) ?></div>
                                <small><?= $config['moneda'] ?></small>
                            </div>
                            <div style="font-size: 40px; opacity: 0.2;">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráficos -->
            <div class="row mb-5">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0"><i class="fas fa-chart-bar"></i> Tendencia de Ventas</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="ventasChart" height="80"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0"><i class="fas fa-chart-pie"></i> Planes Populares</h5>
                        </div>
                        <div class="card-body d-flex justify-content-center align-items-center" style="height: 300px;">
                            <canvas id="planesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de Vencimientos -->
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0"><i class="fas fa-hourglass-end"></i> Próximos Vencimientos (7 días)</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Socio</th>
                                    <th>Plan</th>
                                    <th>Fecha de Vencimiento</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($vencimientos)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <i class="fas fa-check-circle text-success" style="font-size: 24px;"></i>
                                            <p class="text-muted mt-2">No hay vencimientos cercanos</p>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach($vencimientos as $v): ?>
                                    <tr>
                                        <td>
                                            <strong><?= $v['socio'] ?></strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary"><?= $v['plan'] ?></span>
                                        </td>
                                        <td>
                                            <strong class="text-danger"><?= date('d/m/Y', strtotime($v['fecha_fin'])) ?></strong>
                                        </td>
                                        <td>
                                            <a href="/suscripciones/crear" class="btn btn-sm btn-success">
                                                <i class="fas fa-sync"></i> Renovar
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <script>
                // Gráfico de Ventas
                const ctx = document.getElementById('ventasChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?= json_encode($labels) ?>,
                        datasets: [{
                            label: 'Ventas del Mes',
                            data: <?= json_encode($data) ?>,
                            backgroundColor: 'rgba(102, 126, 234, 0.8)',
                            borderColor: '#667eea',
                            borderWidth: 2,
                            borderRadius: 8,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    drawBorder: false,
                                    color: 'rgba(0, 0, 0, 0.05)'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });

                // Gráfico de Planes
                const ctx2 = document.getElementById('planesChart').getContext('2d');
                new Chart(ctx2, {
                    type: 'doughnut',
                    data: {
                        labels: <?= json_encode($planesLabels) ?>,
                        datasets: [{
                            data: <?= json_encode($planesData) ?>,
                            backgroundColor: [
                                'rgba(102, 126, 234, 0.8)',
                                'rgba(6, 214, 160, 0.8)',
                                'rgba(255, 165, 2, 0.8)',
                                'rgba(233, 69, 96, 0.8)',
                                'rgba(76, 175, 80, 0.8)'
                            ],
                            borderColor: 'white',
                            borderWidth: 3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 15,
                                    font: { size: 12 }
                                }
                            }
                        }
                    }
                });
            </script>

        <?php else: ?>
            
            <!-- Hero Welcome Section for Non-Admin Users -->
            <div class="card card-welcome shadow-lg border-0 mb-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; overflow: hidden;">
                <div class="card-body py-5">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="fw-bold mb-3" style="font-size: 32px;">
                                <i class="fas fa-wave-hand"></i> ¡Bienvenido, <?= $_SESSION['user_name'] ?? 'Usuario' ?>!
                            </h1>
                            <p class="lead mb-2">Tu rol de acceso: <span class="badge bg-light text-primary fw-bold"><?= strtoupper(ucfirst($_SESSION['user_rol'] ?? 'invitado')) ?></span></p>
                            <p style="opacity: 0.9;">Accede a las funciones disponibles para tu perfil y gestiona las operaciones del gimnasio.</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <i class="fas fa-dumbbell" style="font-size: 80px; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row mb-5">
                <div class="col-12">
                    <h5 class="mb-4"><i class="fas fa-bolt"></i> Acciones Rápidas</h5>
                </div>
                
                <div class="col-md-6 col-lg-4 mb-3">
                    <a href="/asistencia/index" class="text-decoration-none">
                        <div class="card card-action h-100 border-0 shadow-sm">
                            <div class="card-body text-center py-4">
                                <i class="fas fa-clock" style="font-size: 32px; color: #667eea; margin-bottom: 10px;"></i>
                                <h6 class="fw-bold">Control de Asistencia</h6>
                                <p class="text-muted small mb-0">Registra entradas y salidas</p>
                            </div>
                        </div>
                    </a>
                </div>

                <?php if($_SESSION['user_rol'] == 'recepcionista'): ?>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <a href="/suscripciones/crear" class="text-decoration-none">
                            <div class="card card-action h-100 border-0 shadow-sm">
                                <div class="card-body text-center py-4">
                                    <i class="fas fa-plus-circle" style="font-size: 32px; color: #06d6a0; margin-bottom: 10px;"></i>
                                    <h6 class="fw-bold">Nueva Venta</h6>
                                    <p class="text-muted small mb-0">Crear nueva suscripción</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3">
                        <a href="/caja/index" class="text-decoration-none">
                            <div class="card card-action h-100 border-0 shadow-sm">
                                <div class="card-body text-center py-4">
                                    <i class="fas fa-cash-register" style="font-size: 32px; color: #ffa502; margin-bottom: 10px;"></i>
                                    <h6 class="fw-bold">Ver Caja</h6>
                                    <p class="text-muted small mb-0">Estado de la caja</p>
                                </div>
                            </div>
                        </a>
                    </div>

                <?php elseif($_SESSION['user_rol'] == 'entrenador'): ?>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <a href="/socios/index" class="text-decoration-none">
                            <div class="card card-action h-100 border-0 shadow-sm">
                                <div class="card-body text-center py-4">
                                    <i class="fas fa-chart-line" style="font-size: 32px; color: #06d6a0; margin-bottom: 10px;"></i>
                                    <h6 class="fw-bold">Ver Progreso de Socios</h6>
                                    <p class="text-muted small mb-0">Seguimiento de socios</p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Table of Expiring Memberships -->
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0"><i class="fas fa-hourglass-end"></i> Vencimientos Próximos</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Socio</th>
                                    <th>Plan</th>
                                    <th>Vencimiento</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($vencimientos)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            <i class="fas fa-check-circle text-success" style="font-size: 24px;"></i>
                                            <p class="text-muted mt-2">No hay vencimientos cercanos</p>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach($vencimientos as $v): ?>
                                    <tr>
                                        <td><?= $v['socio'] ?></td>
                                        <td><span class="badge bg-primary"><?= $v['plan'] ?></span></td>
                                        <td><strong class="text-danger"><?= date('d/m/Y', strtotime($v['fecha_fin'])) ?></strong></td>
                                        <td><span class="badge bg-warning text-dark">Por Vencer</span></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        <?php endif; ?>

    </div>

    <style>
        .card-welcome {
            transition: transform 0.3s ease;
        }
        
        .card-welcome:hover {
            transform: translateY(-2px);
        }

        .card-action {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .card-action:hover {
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.15) !important;
            transform: translateY(-4px);
            background: var(--light) !important;
        }

        .kpi-card {
            position: relative;
            overflow: hidden;
        }

        .kpi-card::after {
            content: '';
            position: absolute;
            bottom: -30px;
            right: -30px;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        }
    </style>
    
    <?php require_once '../app/views/inc/footer.php'; ?>
</body>
</html>