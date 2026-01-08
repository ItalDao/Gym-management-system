<?php
// 1. Cargar el modelo de Configuración de forma segura
require_once __DIR__ . '/../../models/Configuracion.php';

// 2. Obtener los datos de la empresa
$config = Configuracion::getInfo();
?>

<style>
    .navbar-premium {
        background: linear-gradient(135deg, #FFFFFF 0%, #F3F4F6 50%, #FFFFFF 100%);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        position: relative;
        border-bottom: 4px solid #DC2626;
        color: #111827;
    }
    
    .navbar-premium h1, .navbar-premium h2, .navbar-premium h3, 
    .navbar-premium h4, .navbar-premium h5, .navbar-premium h6,
    .navbar-premium p, .navbar-premium span, .navbar-premium a {
        color: #111827 !important;
    }

    .navbar-premium::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, transparent, #DC2626, transparent);
        opacity: 0.8;
    }

    .navbar-brand-premium {
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 800;
        font-size: 18px;
        color: #111827 !important;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        letter-spacing: 0.5px;
    }

    .navbar-brand-premium:hover {
        transform: translateY(-2px);
        text-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }

    .navbar-brand-premium img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        padding: 6px;
        background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%);
        border: 2px solid rgba(220, 38, 38, 0.2);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.15);
        transition: all 0.3s ease;
    }

    .navbar-brand-premium:hover img {
        transform: scale(1.1) rotate(3deg);
        box-shadow: 0 6px 16px rgba(220, 38, 38, 0.3);
    }

    .nav-link-premium {
        color: #4B5563 !important;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0 4px;
        padding: 10px 14px !important;
        border-radius: 8px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .nav-link-premium::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(220, 38, 38, 0.15), transparent);
        transition: left 0.5s ease;
    }

    .nav-link-premium:hover {
        color: #DC2626 !important;
        background: rgba(220, 38, 38, 0.1);
        border-bottom: 2px solid #DC2626;
        transform: translateY(-2px);
    }

    .nav-link-premium:hover::before {
        left: 100%;
    }

    .nav-link-premium i {
        margin-right: 6px;
    }

    .nav-link-active-premium {
        color: #DC2626 !important;
        background: rgba(220, 38, 38, 0.1) !important;
        border-bottom: 2px solid #DC2626 !important;
    }

    .navbar-toggler-premium {
        border: 2px solid #DC2626;
        padding: 6px 10px;
        transition: all 0.3s ease;
    }

    .navbar-toggler-premium:hover {
        background: rgba(220, 38, 38, 0.1);
        transform: scale(1.05);
    }

    .dropdown-menu-premium {
        background: linear-gradient(135deg, #FFFFFF 0%, #F8FAFC 100%);
        border: 1px solid rgba(34, 197, 94, 0.2);
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        margin-top: 8px;
        animation: dropdownSlide 0.3s ease-out;
    }

    @keyframes dropdownSlide {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-item-premium {
        color: #6B7280 !important;
        font-size: 13px;
        padding: 12px 16px !important;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }

    .dropdown-item-premium:hover {
        background: rgba(220, 38, 38, 0.1) !important;
        color: #DC2626 !important;
        border-left-color: #DC2626;
        padding-left: 20px !important;
    }

    .dropdown-item-logout {
        color: #EF4444 !important;
        border-left: 3px solid transparent;
    }

    .dropdown-item-logout:hover {
        background: rgba(239, 68, 68, 0.1) !important;
        color: #EF4444 !important;
        border-left-color: #EF4444;
    }

    .user-badge-premium {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        background: rgba(220, 38, 38, 0.1);
        border-radius: 20px;
        border: 1px solid rgba(220, 38, 38, 0.3);
        transition: all 0.3s ease;
    }

    .user-badge-premium:hover {
        background: rgba(220, 38, 38, 0.15);
        border-color: #DC2626;
    }

    .user-badge-premium small {
        color: #6B7280;
        font-size: 11px !important;
    }

    .navbar-divider-premium {
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(220, 38, 38, 0.2), transparent);
    }
</style>

<nav class="navbar navbar-expand-lg navbar-premium mb-4">
    <div class="container">
        
        <a class="navbar-brand-premium" href="/home/index">
            <?php if(!empty($config['logo'])): ?>
                <img src="/img/<?= $config['logo'] ?>?v=<?= time() ?>" alt="Logo">
            <?php else: ?>
                <i class="fas fa-dumbbell" style="font-size: 28px; background: linear-gradient(135deg, #d4af37 0%, #b8941f 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
            <?php endif; ?>
            <span><?= $config['nombre_sistema'] ?></span>
        </a>
        
        <button class="navbar-toggler navbar-toggler-premium" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
            <i class="fas fa-bars" style="color: #d4af37;"></i>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto" style="gap: 4px;">
                
                <li class="nav-item">
                    <a class="nav-link-premium nav-link-active-premium" href="/asistencia/index"><i class="fas fa-clock"></i> Asistencia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-premium" href="/socios/index"><i class="fas fa-users"></i> Socios</a>
                </li>

                <?php if(isset($_SESSION['user_rol']) && $_SESSION['user_rol'] != 'entrenador'): ?>
                    <li class="nav-item">
                        <a class="nav-link-premium" href="/caja/index"><i class="fas fa-cash-register"></i> Caja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-premium" href="/suscripciones/index"><i class="fas fa-file-invoice-dollar"></i> Suscripciones</a>
                    </li>
                <?php endif; ?>

                <?php if(isset($_SESSION['user_rol']) && $_SESSION['user_rol'] == 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link-premium" href="/planes/index"><i class="fas fa-dumbbell"></i> Planes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-premium" href="/gastos/index"><i class="fas fa-money-bill-wave"></i> Gastos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-premium" href="/usuarios/index"><i class="fas fa-user-shield"></i> Usuarios</a>
                    </li>
                <?php endif; ?>

            </ul>

            <div class="navbar-divider-premium d-lg-none my-2"></div>

            <ul class="navbar-nav ms-lg-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link-premium dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="user-badge-premium">
                            <i class="fas fa-user-circle"></i> 
                            <span><?= $_SESSION['user_name'] ?? 'Usuario' ?></span>
                            <small>(<?= ucfirst($_SESSION['user_rol'] ?? '') ?>)</small>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-premium dropdown-menu-end">
                        
                        <?php if(isset($_SESSION['user_rol']) && $_SESSION['user_rol'] == 'admin'): ?>
                            <li><a class="dropdown-item dropdown-item-premium" href="/configuracion/index"><i class="fas fa-cogs"></i> Configuración</a></li>
                            <li><hr class="dropdown-divider navbar-divider-premium"></li>
                        <?php endif; ?>
                        
                        <li><a class="dropdown-item dropdown-item-logout" href="/auth/logout"><i class="fas fa-sign-out-alt"></i> Salir del Sistema</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>