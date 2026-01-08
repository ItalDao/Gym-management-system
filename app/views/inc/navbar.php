<?php
require_once __DIR__ . '/../../models/Configuracion.php';
$config = Configuracion::getInfo();
?>

<style>
    /* ===== NAVBAR MINI STYLES ===== */
    .navbar-mini {
        background: linear-gradient(135deg, #FFFFFF 0%, #F3F4F6 100%);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1040;
        border-bottom: 2px solid #E5E7EB;
    }

    .navbar-mini-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .navbar-toggle-btn {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 22px;
        color: #3B82F6;
        padding: 8px 12px;
        transition: all 0.2s ease;
        display: none;
    }

    .navbar-toggle-btn:hover {
        color: #1E40AF;
        transform: scale(1.1);
    }

    .navbar-brand-mini {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 800;
        font-size: 16px;
        color: #111827;
        text-decoration: none;
        white-space: nowrap;
    }

    .navbar-brand-icon {
        width: 35px;
        height: 35px;
        background: linear-gradient(135deg, #3B82F6 0%, #DC2626 100%);
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 800;
        font-size: 16px;
    }

    .navbar-mini-right {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .navbar-user-menu {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 6px 12px;
        background: rgba(59, 130, 246, 0.1);
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
    }

    .navbar-user-menu:hover {
        background: rgba(59, 130, 246, 0.15);
    }

    .navbar-user-avatar {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 12px;
    }

    .navbar-user-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .navbar-user-name {
        font-weight: 600;
        font-size: 12px;
        color: #111827;
    }

    .navbar-user-role {
        font-size: 10px;
        color: #6B7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .navbar-user-dropdown {
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        border: 1px solid #E5E7EB;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        min-width: 180px;
        display: none;
        z-index: 2000;
        margin-top: 5px;
    }

    .navbar-user-menu.active .navbar-user-dropdown {
        display: block;
    }

    .navbar-dropdown-item {
        display: block;
        padding: 12px 16px;
        color: #4B5563;
        text-decoration: none;
        font-size: 13px;
        transition: all 0.2s ease;
        border-bottom: 1px solid #F3F4F6;
    }

    .navbar-dropdown-item:last-child {
        border-bottom: none;
    }

    .navbar-dropdown-item:hover {
        background: rgba(59, 130, 246, 0.1);
        color: #3B82F6;
        padding-left: 20px;
    }

    .navbar-dropdown-item.danger:hover {
        background: rgba(220, 38, 38, 0.1);
        color: #DC2626;
    }

    .navbar-dropdown-item i {
        margin-right: 8px;
        width: 16px;
        text-align: center;
    }

    /* Mobile responsive */
    @media (max-width: 768px) {
        .navbar-toggle-btn {
            display: block;
        }

        .navbar-brand-mini span {
            display: none;
        }

        .navbar-user-info {
            display: none;
        }
    }

    /* Adjust body for fixed navbar */
    body {
        padding-top: 70px;
    }
</style>

<!-- NAVBAR MINI -->
<nav class="navbar-mini">
    <div class="navbar-mini-left">
        <!-- Toggle Sidebar Button -->
        <button class="navbar-toggle-btn" id="sidebarToggle" title="Alternar sidebar">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Brand -->
        <a href="/" class="navbar-brand-mini">
            <div class="navbar-brand-icon">
                <i class="fas fa-dumbbell"></i>
            </div>
            <span><?= substr($config['nombre_sistema'] ?? 'GYM', 0, 15) ?></span>
        </a>
    </div>

    <div class="navbar-mini-right">
        <!-- User Menu -->
        <div class="navbar-user-menu" id="userMenuToggle" onclick="toggleUserMenu(event)">
            <div class="navbar-user-avatar">
                <?= strtoupper(substr($_SESSION['user_name'] ?? 'U', 0, 1)) ?>
            </div>
            <div class="navbar-user-info">
                <div class="navbar-user-name"><?= $_SESSION['user_name'] ?? 'Usuario' ?></div>
                <div class="navbar-user-role"><?= ucfirst($_SESSION['user_rol'] ?? 'usuario') ?></div>
            </div>
            <i class="fas fa-chevron-down" style="font-size: 12px; color: #6B7280;"></i>

            <!-- Dropdown Menu -->
            <div class="navbar-user-dropdown">
                <a href="/home" class="navbar-dropdown-item">
                    <i class="fas fa-user"></i> Mi Perfil
                </a>
                <a href="/configuracion" class="navbar-dropdown-item">
                    <i class="fas fa-cog"></i> Configuración
                </a>
                <hr style="margin: 6px 0; border: none; border-top: 1px solid #F3F4F6;">
                <a href="/auth/logout" class="navbar-dropdown-item danger">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleUserMenu(event) {
        event.stopPropagation();
        const userMenu = document.getElementById('userMenuToggle');
        userMenu.classList.toggle('active');
    }

    // Close user menu when clicking outside
    document.addEventListener('click', () => {
        const userMenu = document.getElementById('userMenuToggle');
        userMenu.classList.remove('active');
    });

    // Sidebar toggle
    const sidebarToggle = document.getElementById('sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', () => {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');

            if (!sidebar) return;

            if (window.innerWidth > 768) {
                sidebar.classList.toggle('collapsed');
                mainContent?.classList.toggle('expanded');
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
            } else {
                sidebar.classList.toggle('mobile-open');
            }
        });
    }
</script>

<!-- Main Content Wrapper -->
<div class="main-content">