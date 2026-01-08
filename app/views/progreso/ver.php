<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Progreso del Socio - <?= $config['nombre_sistema'] ?? 'Gym' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .pestaña-medida-premium {
            background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%);
            color: white;
        }
        .pestaña-rutina-premium {
            background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%);
            color: white;
        }
        .tab-link-active {
            border-bottom: 4px solid #3B82F6;
            color: #3B82F6 !important;
        }
    </style>
</head>
<body class="bg-light">

    <?php require_once '../app/views/inc/navbar.php'; ?>

    <div class="container mt-4 mb-5">
        
        <!-- Header Premium con datos del socio -->
        <div class="card border-0 shadow mb-4">
            <div style="background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%); padding: 30px; display: flex; align-items: center; gap: 30px; border-radius: 15px 15px 0 0; color: white;">
                <div>
                    <?php if(!empty($socio['foto'])): ?>
                        <img src="/img/socios/<?= $socio['foto'] ?>" class="rounded-circle" width="100" height="100" style="object-fit:cover; border: 4px solid white;">
                    <?php else: ?>
                        <i class="fas fa-user-circle" style="font-size: 100px; color: white;"></i>
                    <?php endif; ?>
                </div>
                <div style="flex: 1;">
                    <h2 style="margin: 0 0 8px; font-weight: 800;"><?= $socio['nombre'] ?></h2>
                    <p style="margin: 0 0 4px; opacity: 0.9;"><i class="fas fa-id-card"></i> DNI: <?= $socio['dni'] ?></p>
                    <p style="margin: 0; opacity: 0.9;"><i class="fas fa-phone"></i> <?= $socio['telefono'] ?></p>
                </div>
                <div>
                    <a href="/socios/index" style="background: rgba(255, 255, 255, 0.2); border: 2px solid white; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-block; transition: all 0.3s ease;">
                        <i class="fas fa-arrow-left"></i> Volver a Lista
                    </a>
                </div>
            </div>
        </div>

        <!-- Tabs Premium -->
        <ul class="nav mb-4" id="myTab" role="tablist" style="border-bottom: none;">
            <li class="nav-item" role="presentation">
                <button class="nav-link active tab-link-active" id="medidas-tab" data-bs-toggle="tab" data-bs-target="#medidas" type="button" style="padding: 15px 30px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; border: none; background: none; color: #999; transition: all 0.3s ease;">
                    <i class="fas fa-weight"></i> Medidas y Gráficos
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="rutina-tab" data-bs-toggle="tab" data-bs-target="#rutina" type="button" style="padding: 15px 30px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; border: none; background: none; color: #999; transition: all 0.3s ease;">
                    <i class="fas fa-dumbbell"></i> Rutina Semanal
                </button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            
            <!-- TAB: Medidas -->
            <div class="tab-pane fade show active" id="medidas">
                <div class="row">
                    <!-- Formulario Nuevo Registro -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow">
                            <div class="pestaña-medida-premium" style="padding: 30px; text-align: center; border-radius: 15px 15px 0 0;">
                                <i class="fas fa-plus-circle" style="font-size: 32px; display: block; margin-bottom: 10px;"></i>
                                <h5 style="margin: 0; font-weight: 700;">Nueva Medida</h5>
                            </div>
                            <div class="card-body p-4">
                                <form action="/progreso/guardar_medida" method="POST">
                                    <input type="hidden" name="socio_id" value="<?= $socio['id'] ?>">
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">
                                            <i class="fas fa-calendar"></i> Fecha
                                        </label>
                                        <input type="date" name="fecha" class="form-control" style="border: 2px solid #e0e0e0; padding: 10px 12px; border-radius: 8px;" value="<?= date('Y-m-d') ?>" required>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Peso (Kg)</label>
                                            <input type="number" step="0.01" name="peso" class="form-control" style="border: 2px solid #e0e0e0; padding: 10px 12px; border-radius: 8px;" required>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">% Grasa</label>
                                            <input type="number" step="0.01" name="grasa" class="form-control" style="border: 2px solid #e0e0e0; padding: 10px 12px; border-radius: 8px;">
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Cintura (cm)</label>
                                            <input type="number" step="0.01" name="cintura" class="form-control" style="border: 2px solid #e0e0e0; padding: 10px 12px; border-radius: 8px;">
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="form-label fw-bold text-uppercase small text-muted" style="letter-spacing: 0.5px;">Brazo (cm)</label>
                                            <input type="number" step="0.01" name="brazo" class="form-control" style="border: 2px solid #e0e0e0; padding: 10px 12px; border-radius: 8px;">
                                        </div>
                                    </div>
                                    <button style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%); color: white; font-weight: 700; width: 100%; padding: 12px; border: none; border-radius: 8px; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 10px;">
                                        <i class="fas fa-save"></i> Registrar Medida
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Gráficos y Tabla -->
                    <div class="col-lg-8">
                        
                        <!-- Gráfico de Peso -->
                        <div class="card border-0 shadow mb-4">
                            <div style="background: linear-gradient(135deg, #f5f5f5 0%, #ffffff 100%); padding: 20px; border-radius: 15px 15px 0 0;">
                                <h6 style="margin: 0; font-weight: 700; color: #1a1a1a; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px;">
                                    <i class="fas fa-chart-line" style="color: #3B82F6;"></i> Evolución de Peso
                                </h6>
                            </div>
                            <div class="card-body p-4">
                                <canvas id="pesoChart" style="max-height: 250px;"></canvas>
                            </div>
                        </div>

                        <!-- Historial de Medidas -->
                        <div class="card border-0 shadow">
                            <div style="background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%); padding: 20px; color: white; border-radius: 15px 15px 0 0;">
                                <h6 style="margin: 0; font-weight: 700; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px;">
                                    <i class="fas fa-list"></i> Historial Completo
                                </h6>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead style="background: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 100%);">
                                        <tr>
                                            <th>Fecha</th>
                                            <th style="color: #DC2626;">Peso</th>
                                            <th>Grasa</th>
                                            <th>Cintura</th>
                                            <th>Brazo</th>
                                            <th style="text-align: center;">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($medidas as $m): ?>
                                        <tr>
                                            <td><small class="text-muted"><?= date('d/m/Y', strtotime($m['fecha'])) ?></small></td>
                                            <td><strong style="color: #10B981;"><?= $m['peso'] ?> kg</strong></td>
                                            <td><?= $m['grasa'] ?> %</td>
                                            <td><?= $m['cintura'] ?> cm</td>
                                            <td><?= $m['brazo'] ?> cm</td>
                                            <td style="text-align: center;">
                                                <a href="/progreso/eliminar_medida/<?= $m['id'] ?>/<?= $socio['id'] ?>" style="color: #DC2626; text-decoration: none; transition: all 0.3s ease;" onclick="return confirm('¿Eliminar esta medida?');"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB: Rutina Semanal -->
            <div class="tab-pane fade" id="rutina">
                <form action="/progreso/guardar_rutina" method="POST">
                    <input type="hidden" name="socio_id" value="<?= $socio['id'] ?>">
                    
                    <div class="row mb-4">
                        <?php 
                            $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
                            $campos = ['dia1', 'dia2', 'dia3', 'dia4', 'dia5', 'dia6'];
                            $colores = ['#3B82F6', '#DC2626', '#10B981', '#1F2937', '#F3F4F6'];
                        ?>
                        
                        <?php for($i=0; $i<6; $i++): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card border-0 shadow h-100">
                                <div style="background: linear-gradient(135deg, <?= $colores[$i] ?> 0%, <?= $colores[$i] ?>cc 100%); padding: 15px; text-align: center; color: white; border-radius: 15px 15px 0 0; font-weight: 700;">
                                    <i class="fas fa-calendar-day"></i> <?= $dias[$i] ?>
                                </div>
                                <div class="card-body p-3">
                                    <textarea name="<?= $campos[$i] ?>" class="form-control" style="border: 2px solid #e0e0e0; resize: vertical; min-height: 120px; border-radius: 8px; padding: 12px; font-size: 13px;" placeholder="Ej: 4x12 Press Banca&#10;3x10 Dominadas..."><?= $rutina[$campos[$i]] ?? '' ?></textarea>
                                </div>
                            </div>
                        </div>
                        <?php endfor; ?>
                        
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                <i class="fas fa-sticky-note"></i> Observaciones Generales
                            </label>
                            <input type="text" name="observaciones" class="form-control" style="border: 2px solid #e0e0e0; padding: 12px 16px; border-radius: 8px;" value="<?= $rutina['observaciones'] ?? '' ?>" placeholder="Ej: Enfocarse en la técnica, beber mucha agua, descansar bien...">
                        </div>
                    </div>

                    <div style="display: grid;">
                        <button type="submit" style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%); color: white; font-weight: 700; padding: 16px; border: none; border-radius: 10px; text-transform: uppercase; letter-spacing: 1px; cursor: pointer;">
                            <i class="fas fa-save"></i> GUARDAR RUTINA SEMANAL
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        const ctx = document.getElementById('pesoChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($labels) ?>,
                datasets: [{
                    label: 'Evolución de Peso (Kg)',
                    data: <?= json_encode($dataPeso) ?>,
                    borderColor: '#DC2626',
                    backgroundColor: 'rgba(220, 38, 38, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 3,
                    pointRadius: 6,
                    pointBackgroundColor: '#DC2626',
                    pointBorderColor: 'white',
                    pointBorderWidth: 2,
                    pointHoverRadius: 8
                }]
            },
            options: { 
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            font: { weight: 'bold', size: 12 },
                            color: '#1a1a1a'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: { color: '#f0f0f0' },
                        ticks: { color: '#666' }
                    },
                    x: {
                        grid: { color: '#f0f0f0' },
                        ticks: { color: '#666' }
                    }
                }
            }
        });

        // Mantener pestaña activa si recargas
        if(window.location.href.indexOf("tab=rutina") > -1) {
            var tabTrigger = new bootstrap.Tab(document.getElementById('rutina-tab'));
            tabTrigger.show();
        }
    </script>

    <?php require_once '../app/views/inc/footer.php'; ?>