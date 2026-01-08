<?php
// app/views/auth/login.php
require_once __DIR__ . '/../../models/Configuracion.php';
$config = Configuracion::getInfo();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso - <?= $config['nombre_sistema'] ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/css/styles.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 50%, #E0F2FE 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica Neue', sans-serif;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Animated background elements */
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 20s ease-in-out infinite;
            z-index: 1;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -20%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(220, 38, 38, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 25s ease-in-out infinite reverse;
            z-index: 1;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(180deg); }
        }

        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 480px;
        }

        /* Modern card with glassmorphism effect */
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25), 
                        0 0 1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.5);
            animation: cardAppear 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes cardAppear {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Premium header */
        .login-header {
            background: linear-gradient(135deg, #DC2626 0%, #991B1B 50%, #B91C1C 100%);
            padding: 50px 30px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
            animation: shine 3s infinite;
            pointer-events: none;
        }

        @keyframes shine {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .logo-container {
            position: relative;
            margin-bottom: 20px;
        }

        .logo-login {
            max-height: 100px;
            max-width: 90%;
            object-fit: contain;
            display: block;
            margin: 0 auto;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.15);
            padding: 10px;
            border: 2px solid rgba(255, 255, 255, 0.25);
            transition: all 0.3s ease;
            animation: logoFloat 3s ease-in-out infinite;
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }

        .logo-login:hover {
            transform: scale(1.05);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .login-header h1 {
            font-size: 32px;
            font-weight: 800;
            margin: 0 0 8px;
            color: white;
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            letter-spacing: -0.5px;
        }

        .login-header p {
            margin: 0;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.85);
            position: relative;
            z-index: 2;
            font-weight: 500;
        }

        .login-body {
            padding: 45px 35px;
        }

        /* Enhanced form groups */
        .form-group {
            margin-bottom: 28px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: #1a1a1a;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-group label i {
            color: #DC2626;
            font-size: 14px;
        }

        /* Premium input styling */
        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e8e8e8;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
            color: #1a1a1a;
            font-weight: 500;
            position: relative;
        }

        .form-control:focus {
            outline: none;
            border-color: #DC2626;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.1),
                        0 4px 12px rgba(34, 197, 94, 0.15);
            background: #fafafa;
            transform: translateY(-2px);
        }

        .form-control::placeholder {
            color: #b0b0b0;
            font-weight: 400;
        }

        /* Premium button */
        .btn-login {
            width: 100%;
            padding: 16px 24px;
            background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
            font-size: 14px;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.5s ease;
            z-index: 1;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(34, 197, 94, 0.4);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .btn-login span {
            position: relative;
            z-index: 2;
        }

        /* Alert styling */
        .alert {
            padding: 16px 18px;
            border-radius: 10px;
            margin-bottom: 28px;
            font-weight: 500;
            border-left: 4px solid #DC2626;
            background: linear-gradient(135deg, #ffe6e6 0%, #fff5f5 100%);
            color: #DC2626;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            animation: alertSlide 0.4s ease-out;
        }

        @keyframes alertSlide {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .alert i {
            flex-shrink: 0;
            margin-top: 2px;
            font-size: 16px;
        }

        /* Footer */
        .login-footer {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            padding: 24px 30px;
            text-align: center;
            border-top: 1px solid #e0e0e0;
        }

        .login-footer p {
            margin: 0;
            font-size: 12px;
            color: #999;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .login-container {
                max-width: 100%;
            }

            .login-card {
                border-radius: 16px;
            }

            .login-header {
                padding: 40px 25px 35px;
            }

            .login-header h1 {
                font-size: 26px;
            }

            .login-body {
                padding: 35px 25px;
            }

            .btn-login {
                padding: 14px 20px;
                font-size: 13px;
            }

            .logo-login {
                max-height: 80px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-card">
            <!-- Premium Header -->
            <div class="login-header">
                <div class="logo-container">
                    <?php if(!empty($config['logo'])): ?>
                        <img src="/img/<?= $config['logo'] ?>?v=<?= time() ?>" class="logo-login" alt="Logo">
                    <?php else: ?>
                        <i class="fas fa-dumbbell" style="font-size: 80px; color: white; display: block;"></i>
                    <?php endif; ?>
                </div>
                <h1><?= $config['nombre_sistema'] ?></h1>
                <p><i class="fas fa-lock"></i> Centro de Control</p>
            </div>

            <!-- Body -->
            <div class="login-body">
                
                <?php if(isset($error)): ?>
                    <div class="alert">
                        <i class="fas fa-times-circle"></i>
                        <div><?= $error ?></div>
                    </div>
                <?php endif; ?>

                <form action="/auth/login" method="POST">
                    <div class="form-group">
                        <label>
                            <i class="fas fa-envelope"></i> Correo
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            class="form-control" 
                            placeholder="usuario@example.com" 
                            required 
                            autofocus
                        >
                    </div>
                    
                    <div class="form-group">
                        <label>
                            <i class="fas fa-key"></i> Contraseña
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control" 
                            placeholder="Ingresa tu contraseña" 
                            required
                        >
                    </div>
                    
                    <button type="submit" class="btn-login">
                        <span><i class="fas fa-sign-in-alt"></i> INGRESAR</span>
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div class="login-footer">
                <p>&copy; <span id="year"></span> <?= $config['nombre_sistema'] ?> - Todos los derechos reservados</p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
        
        // Animación en inputs
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.closest('.form-group').style.opacity = '1';
            });
        });
    </script>

</body>
</html>