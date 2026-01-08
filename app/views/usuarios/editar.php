<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario - <?= $config['nombre_sistema'] ?? 'Gym' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body class="bg-light">
    <?php require_once '../app/views/inc/navbar.php'; ?>
    
    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow">
                    <!-- Premium Header - Cyan para editar -->
                    <div style="background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%); padding: 40px 30px; text-align: center; color: white;">
                        <i class="fas fa-user-edit" style="font-size: 40px; display: block; margin-bottom: 15px;"></i>
                        <h2 style="margin: 0 0 8px; font-weight: 800; font-size: 28px;">Editar Usuario</h2>
                        <p style="margin: 0; opacity: 0.9; font-size: 14px;">Actualice la información del usuario</p>
                    </div>

                    <div class="card-body p-5">
                        <form action="/usuarios/actualizar" method="POST">
                            <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                            
                            <!-- Nombre Completo -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                    <i class="fas fa-user"></i> Nombre Completo
                                </label>
                                <input 
                                    type="text" 
                                    name="nombre" 
                                    class="form-control" 
                                    value="<?= $usuario['nombre'] ?>"
                                    style="padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px; transition: all 0.3s ease;"
                                    required
                                    autofocus
                                >
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                    <i class="fas fa-envelope"></i> Email
                                </label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    class="form-control"
                                    value="<?= $usuario['email'] ?>"
                                    style="padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px; transition: all 0.3s ease;"
                                    required
                                >
                            </div>

                            <!-- Nueva Contraseña -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                    <i class="fas fa-lock"></i> Nueva Contraseña
                                </label>
                                <input 
                                    type="password" 
                                    name="password" 
                                    class="form-control"
                                    style="padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px; transition: all 0.3s ease;"
                                    placeholder="Dejar en blanco para no cambiar"
                                >
                            </div>

                            <!-- Rol -->
                            <div class="mb-5">
                                <label class="form-label fw-bold text-uppercase text-muted small" style="letter-spacing: 0.5px;">
                                    <i class="fas fa-shield-alt"></i> Rol de Acceso
                                </label>
                                <select 
                                    name="rol" 
                                    class="form-select"
                                    style="padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px; transition: all 0.3s ease;"
                                    required
                                >
                                    <option value="recepcionista" <?= $usuario['rol']=='recepcionista'?'selected':'' ?>>👥 Recepcionista</option>
                                    <option value="entrenador" <?= $usuario['rol']=='entrenador'?'selected':'' ?>>💪 Entrenador</option>
                                    <option value="admin" <?= $usuario['rol']=='admin'?'selected':'' ?>>👑 Administrador</option>
                                </select>
                            </div>

                            <!-- Botones -->
                            <div style="display: grid; gap: 12px;">
                                <button 
                                    type="submit" 
                                    style="background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%); color: white; font-weight: 700; padding: 14px; border-radius: 8px; border: none; text-transform: uppercase; letter-spacing: 1px; font-size: 14px; cursor: pointer;"
                                >
                                    <i class="fas fa-sync-alt"></i> ACTUALIZAR USUARIO
                                </button>
                                <a 
                                    href="/usuarios/index" 
                                    style="background: white; color: #666; padding: 12px; border-radius: 8px; text-align: center; text-decoration: none; font-weight: 600; border: 2px solid #e0e0e0; transition: all 0.3s ease;"
                                >
                                    <i class="fas fa-arrow-left"></i> Volver a Usuarios
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>