<?php
// Cargar configuración
require_once __DIR__ . '/../../models/Configuracion.php';
$config = Configuracion::getInfo();
$userRole = $_SESSION['user_rol'] ?? 'usuario';
?>

<style>
    /* ===== SIDEBAR STYLES ===== */
    .sidebar-wrapper {
        position: fixed;
        left: 0;
        top: 70px;
        width: 280px;
        height: calc(100vh - 70px);
        background: linear-gradient(135deg, #FFFFFF 0%, #F3F4F6 100%);
        border-right: 2px solid #E5E7EB;
        overflow-y: auto;
        overflow-x: hidden;
        z-index: 1000;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 2px 0 8px rgba(0, 0, 0, 0.08);
    }

    .sidebar-wrapper.collapsed {
        width: 0;
        border-right: none;
    }

    .sidebar-wrapper::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-wrapper::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-wrapper::-webkit-scrollbar-thumb {
        background: #D1D5DB;
        border-radius: 3px;
    }

    .sidebar-wrapper::-webkit-scrollbar-thumb:hover {
        background: #9CA3AF;
    }

    /* Main content adjustment */
    .main-content {
        margin-left: 280px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .main-content.expanded {
        margin-left: 0;
    }

    /* Sidebar sections */
    .sidebar-section {
        padding: 20px 0;
        border-bottom: 1px solid #E5E7EB;
    }

    .sidebar-section:first-child {
        padding-top: 10px;
    }

    .sidebar-title {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #6B7280;
        padding: 0 20px;
        margin-bottom: 12px;
    }

    /* Menu items */
    .sidebar-menu-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 20px;
        margin: 4px 0;
        color: #4B5563;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.2s ease;
        border-left: 4px solid transparent;
        position: relative;
    }

    .sidebar-menu-item:hover {
        background: rgba(59, 130, 246, 0.08);
        color: #3B82F6;
        border-left-color: #3B82F6;
        padding-left: 24px;
    }

    .sidebar-menu-item.active {
        background: rgba(59, 130, 246, 0.15);
        color: #3B82F6;
        border-left-color: #3B82F6;
        font-weight: 600;
    }

    .sidebar-menu-item i {
        width: 20px;
        text-align: center;
        font-size: 16px;
    }

    /* Submenu items */
    .sidebar-submenu {
        display: none;
        background: rgba(59, 130, 246, 0.05);
        border-left: 2px solid #3B82F6;
    }

    .sidebar-submenu.show {
        display: block;
    }

    .sidebar-submenu-item {
        padding: 12px 20px 12px 44px;
        color: #6B7280;
        text-decoration: none;
        font-size: 13px;
        display: block;
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
    }

    .sidebar-submenu-item:hover {
        background: rgba(59, 130, 246, 0.1);
        color: #3B82F6;
        border-left-color: #3B82F6;
        padding-left: 48px;
    }

    /* Sidebar brand */
    .sidebar-brand {
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        border-bottom: 2px solid #E5E7EB;
        margin-bottom: 10px;
    }

    .sidebar-brand-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #3B82F6 0%, #DC2626 100%);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 800;
        font-size: 18px;
    }

    .sidebar-brand-text {
        flex: 1;
    }

    .sidebar-brand-name {
        font-weight: 800;
        font-size: 13px;
        color: #111827;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        line-height: 1.2;
    }

    .sidebar-brand-tag {
        font-size: 10px;
        color: #6B7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Collapse toggle in sidebar */
    .sidebar-toggle {
        position: absolute;
        top: -50px;
        right: 10px;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
        color: #4B5563;
        padding: 5px;
        display: none;
    }

    /* Mobile responsive */
    @media (max-width: 768px) {
        .sidebar-wrapper {
            width: 0;
            z-index: 1050;
        }

        .sidebar-wrapper.mobile-open {
            width: 280px;
        }

        .main-content {
            margin-left: 0;
        }

        .sidebar-toggle {
            display: block;
        }
    }
</style>

<!-- SIDEBAR -->
<div class="sidebar-wrapper" id="sidebar">
    
    <!-- Brand Section -->
    <div class="sidebar-brand">
        <div class="sidebar-brand-icon">
            <i class="fas fa-dumbbell"></i>
        </div>
        <div class="sidebar-brand-text">
            <div class="sidebar-brand-name"><?= substr($config['nombre_sistema'] ?? 'GYM', 0, 12) ?></div>
            <div class="sidebar-brand-tag">Pro</div>
        </div>
    </div>

    <!-- Main Menu -->
    <div class="sidebar-section">
        <div class="sidebar-title">Principal</div>
        
        <a href="/" class="sidebar-menu-item <?= str_contains($_SERVER['REQUEST_URI'], '/home') || $_SERVER['REQUEST_URI'] == '/' ? 'active' : '' ?>">
            <i class="fas fa-home"></i>
            <span>Inicio</span>
        </a>

        <?php if($userRole == 'admin'): ?>
        <a href="/asistencia" class="sidebar-menu-item <?= str_contains($_SERVER['REQUEST_URI'], '/asistencia') ? 'active' : '' ?>">
            <i class="fas fa-clock"></i>
            <span>Asistencia</span>
        </a>
        <?php endif; ?>
    </div>

    <!-- Management Menu (Admin y Recepcionista) -->
    <?php if($userRole != 'entrenador'): ?>
    <div class="sidebar-section">
        <div class="sidebar-title">Gestión</div>
        
        <a href="/socios" class="sidebar-menu-item <?= str_contains($_SERVER['REQUEST_URI'], '/socios') ? 'active' : '' ?>">
            <i class="fas fa-users"></i>
            <span>Socios</span>
        </a>

        <a href="/suscripciones" class="sidebar-menu-item <?= str_contains($_SERVER['REQUEST_URI'], '/suscripciones') ? 'active' : '' ?>">
            <i class="fas fa-file-invoice-dollar"></i>
            <span>Suscripciones</span>
        </a>

        <a href="/planes" class="sidebar-menu-item <?= str_contains($_SERVER['REQUEST_URI'], '/planes') ? 'active' : '' ?>">
            <i class="fas fa-dumbbell"></i>
            <span>Planes</span>
        </a>
    </div>

    <!-- Financial Menu (Admin y Recepcionista) -->
    <div class="sidebar-section">
        <div class="sidebar-title">Finanzas</div>
        
        <a href="/caja" class="sidebar-menu-item <?= str_contains($_SERVER['REQUEST_URI'], '/caja') ? 'active' : '' ?>">
            <i class="fas fa-cash-register"></i>
            <span>Caja</span>
        </a>

        <a href="/gastos" class="sidebar-menu-item <?= str_contains($_SERVER['REQUEST_URI'], '/gastos') ? 'active' : '' ?>">
            <i class="fas fa-money-bill-wave"></i>
            <span>Gastos</span>
        </a>
    </div>
    <?php endif; ?>

    <!-- Admin Menu -->
    <?php if($userRole == 'admin'): ?>
    <div class="sidebar-section">
        <div class="sidebar-title">Administración</div>
        
        <a href="/usuarios" class="sidebar-menu-item <?= str_contains($_SERVER['REQUEST_URI'], '/usuarios') ? 'active' : '' ?>">
            <i class="fas fa-user-tie"></i>
            <span>Usuarios</span>
        </a>

        <a href="/configuracion" class="sidebar-menu-item <?= str_contains($_SERVER['REQUEST_URI'], '/configuracion') ? 'active' : '' ?>">
            <i class="fas fa-cog"></i>
            <span>Configuración</span>
        </a>
    </div>
    <?php endif; ?>

    <!-- Trainer Menu -->
    <?php if($userRole == 'entrenador'): ?>
    <div class="sidebar-section">
        <div class="sidebar-title">Entrenamientos</div>
        
        <a href="/socios" class="sidebar-menu-item <?= str_contains($_SERVER['REQUEST_URI'], '/socios') ? 'active' : '' ?>">
            <i class="fas fa-users"></i>
            <span>Mis Socios</span>
        </a>

        <a href="/" class="sidebar-menu-item <?= str_contains($_SERVER['REQUEST_URI'], '/home') || $_SERVER['REQUEST_URI'] == '/' ? 'active' : '' ?>">
            <i class="fas fa-home"></i>
            <span>Mi Dashboard</span>
        </a>
    </div>
    <?php endif; ?>

    <!-- Bottom Spacing -->
    <div style="height: 30px;"></div>
</div>

<script>
    // Sidebar toggle functionality
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('.main-content');

    function toggleSidebar() {
        sidebar.classList.toggle('mobile-open');
        if (window.innerWidth > 768) {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        }
    }

    // Restore sidebar state from localStorage
    if (window.innerWidth > 768) {
        const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        if (isCollapsed) {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('expanded');
        }
    }

    // Close sidebar on mobile when clicking a link
    document.querySelectorAll('.sidebar-menu-item').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('mobile-open');
            }
        });
    });

    // Handle window resize
    window.addEventListener('resize', () => {
        if (window.innerWidth > 768) {
            sidebar.classList.remove('mobile-open');
        }
    });
</script>
