<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Socio - <?= $config['nombre_sistema'] ?? 'Gym' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body class="bg-light">

    <?php require_once '../app/views/inc/navbar.php'; ?>

    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card border-0 shadow">
                    <!-- Premium Header - Red para crear -->
                    <div style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%); padding: 40px 30px; text-align: center; color: white;">
                        <i class="fas fa-user-plus" style="font-size: 40px; display: block; margin-bottom: 15px;"></i>
                        <h2 style="margin: 0 0 8px; font-weight: 800; font-size: 28px;">Crear Nuevo Socio</h2>
                        <p style="margin: 0; opacity: 0.9; font-size: 14px;">Registre un nuevo miembro en el gimnasio</p>
                    </div>

                    <div class="card-body p-5">
                        <form action="/socios/guardar" method="POST" enctype="multipart/form-data">
                            
                            <!-- Foto de Perfil -->
                            <div class="mb-5">
                                <label for="foto" class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                    <i class="fas fa-image"></i> Foto de Perfil
                                </label>
                                <div style="border: 2px dashed #d4af37; padding: 30px; border-radius: 10px; text-align: center; background: linear-gradient(135deg, rgba(212, 175, 55, 0.05) 0%, rgba(212, 175, 55, 0.02) 100%);" id="upload-area">
                                    <input type="file" 
                                           class="form-control" 
                                           id="foto"
                                           name="foto" 
                                           accept="image/*"
                                           onchange="previewImage(event)"
                                           style="display: none;">
                                    <label for="foto" style="cursor: pointer; margin: 0;">
                                        <i class="fas fa-cloud-upload-alt" style="font-size: 32px; color: #d4af37; display: block; margin-bottom: 10px;"></i>
                                        <span style="color: #666; font-weight: 600;">Seleccionar imagen o arrastrar</span>
                                    </label>
                                    <small style="color: #999; display: block; margin-top: 8px;">JPG, PNG (máx. 5MB)</small>
                                </div>
                                <div id="preview-container" style="display: none;" class="mt-3 text-center">
                                    <img id="preview" src="" alt="Vista previa" class="rounded" style="max-width: 150px; max-height: 150px; border: 3px solid #d4af37;">
                                </div>
                            </div>

                            <!-- Nombre Completo -->
                            <div class="mb-4">
                                <label for="nombre" class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                    <i class="fas fa-user"></i> Nombre Completo
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="nombre"
                                       name="nombre" 
                                       placeholder="Ej: Juan Carlos Pérez"
                                       style="padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px; transition: all 0.3s ease;"
                                       required
                                       autofocus>
                            </div>

                            <!-- DNI y Teléfono -->
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="dni" class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                        <i class="fas fa-id-card"></i> DNI / Identificación
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="dni"
                                           name="dni" 
                                           placeholder="12345678"
                                           style="padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px; transition: all 0.3s ease;"
                                           required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="telefono" class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                        <i class="fas fa-phone"></i> Teléfono
                                    </label>
                                    <input type="tel" 
                                           class="form-control" 
                                           id="telefono"
                                           name="telefono"
                                           placeholder="+34 600 000 000"
                                           style="padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px; transition: all 0.3s ease;">
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                    <i class="fas fa-envelope"></i> Correo Electrónico
                                </label>
                                <input type="email" 
                                       class="form-control" 
                                       id="email"
                                       name="email"
                                       placeholder="socio@ejemplo.com"
                                       style="padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px; transition: all 0.3s ease;">
                            </div>

                            <!-- Estado Inicial -->
                            <div class="mb-5">
                                <label for="estado" class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                    <i class="fas fa-toggle-on"></i> Estado Inicial
                                </label>
                                <select class="form-select" id="estado" name="estado" style="padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px;">
                                    <option value="activo" selected>✓ Activo</option>
                                    <option value="pendiente">⏳ Pendiente</option>
                                    <option value="inactivo">✗ Inactivo</option>
                                </select>
                            </div>

                            <!-- Botones de Acción -->
                            <div style="display: grid; gap: 12px;">
                                <button type="submit" style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%); color: white; font-weight: 700; padding: 14px; border-radius: 8px; border: none; text-transform: uppercase; letter-spacing: 1px; font-size: 14px; cursor: pointer;">
                                    <i class="fas fa-save"></i> GUARDAR SOCIO
                                </button>
                                <a href="/socios/index" style="background: white; color: #666; padding: 12px; border-radius: 8px; text-align: center; text-decoration: none; font-weight: 600; border: 2px solid #e0e0e0; transition: all 0.3s ease;">
                                    <i class="fas fa-arrow-left"></i> Cancelar
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');
            const container = document.getElementById('preview-container');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                container.style.display = 'none';
            }
        }

        // Drag and drop
        const uploadArea = document.getElementById('upload-area');
        const fileInput = document.getElementById('foto');

        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.style.background = 'linear-gradient(135deg, rgba(212, 175, 55, 0.15) 0%, rgba(212, 175, 55, 0.05) 100%)';
            uploadArea.style.borderColor = '#b8941f';
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.style.background = 'linear-gradient(135deg, rgba(212, 175, 55, 0.05) 0%, rgba(212, 175, 55, 0.02) 100%)';
            uploadArea.style.borderColor = '#d4af37';
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            fileInput.files = e.dataTransfer.files;
            const event = { target: { files: e.dataTransfer.files } };
            previewImage(event);
        });
    </script>
    
    <?php require_once '../app/views/inc/footer.php'; ?>
</body>
</html>