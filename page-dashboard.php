<?php
/**
 * Template Name: Dashboard
 * 
 * This is the template that displays the dashboard page.
 */

// Redirect if user is not logged in
if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
    exit;
}

get_header();
?>

<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Registro de Soldados -->
        <div class="dashboard-card bg-white/95 backdrop-blur-sm rounded-lg shadow-xl p-6 hover:transform hover:scale-105 transition-all cursor-pointer" onclick="window.location.href='<?php echo esc_url(home_url('/registro-soldado')); ?>'">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-blue-100 rounded-full">
                    <i class="fas fa-user-plus text-2xl text-blue-600"></i>
                </div>
                <span class="text-sm font-semibold text-blue-600"><?php _e('Registro', 'hispanoargo'); ?></span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2" data-lang="soldier.registration"><?php _e('Registro de Soldado', 'hispanoargo'); ?></h3>
            <p class="text-gray-600 text-sm"><?php _e('Crear nuevos registros de soldados con información detallada.', 'hispanoargo'); ?></p>
        </div>

        <?php if (current_user_can('administrator')): ?>
        <!-- Gestión de Usuarios -->
        <div class="dashboard-card bg-white/95 backdrop-blur-sm rounded-lg shadow-xl p-6 hover:transform hover:scale-105 transition-all cursor-pointer" onclick="window.location.href='<?php echo esc_url(home_url('/admin')); ?>'">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-green-100 rounded-full">
                    <i class="fas fa-users-cog text-2xl text-green-600"></i>
                </div>
                <span class="text-sm font-semibold text-green-600"><?php _e('Usuarios', 'hispanoargo'); ?></span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2" data-lang="admin.userManagement"><?php _e('Gestión de Usuarios', 'hispanoargo'); ?></h3>
            <p class="text-gray-600 text-sm"><?php _e('Administrar usuarios y sus niveles de acceso.', 'hispanoargo'); ?></p>
        </div>
        <?php endif; ?>

        <!-- Listado de Soldados -->
        <div class="dashboard-card bg-white/95 backdrop-blur-sm rounded-lg shadow-xl p-6 hover:transform hover:scale-105 transition-all cursor-pointer" onclick="window.location.href='<?php echo esc_url(home_url('/soldiers')); ?>'">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-purple-100 rounded-full">
                    <i class="fas fa-list text-2xl text-purple-600"></i>
                </div>
                <span class="text-sm font-semibold text-purple-600"><?php _e('Listado', 'hispanoargo'); ?></span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2"><?php _e('Listado de Soldados', 'hispanoargo'); ?></h3>
            <p class="text-gray-600 text-sm"><?php _e('Ver y gestionar todos los registros de soldados.', 'hispanoargo'); ?></p>
        </div>

        <!-- Reportes -->
        <div class="dashboard-card bg-white/95 backdrop-blur-sm rounded-lg shadow-xl p-6 hover:transform hover:scale-105 transition-all cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-yellow-100 rounded-full">
                    <i class="fas fa-chart-bar text-2xl text-yellow-600"></i>
                </div>
                <span class="text-sm font-semibold text-yellow-600"><?php _e('Reportes', 'hispanoargo'); ?></span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2"><?php _e('Reportes y Estadísticas', 'hispanoargo'); ?></h3>
            <p class="text-gray-600 text-sm"><?php _e('Generar informes y ver estadísticas del sistema.', 'hispanoargo'); ?></p>
        </div>

        <?php if (current_user_can('administrator')): ?>
        <!-- Configuración -->
        <div class="dashboard-card bg-white/95 backdrop-blur-sm rounded-lg shadow-xl p-6 hover:transform hover:scale-105 transition-all cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-red-100 rounded-full">
                    <i class="fas fa-cog text-2xl text-red-600"></i>
                </div>
                <span class="text-sm font-semibold text-red-600"><?php _e('Config', 'hispanoargo'); ?></span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2"><?php _e('Configuración', 'hispanoargo'); ?></h3>
            <p class="text-gray-600 text-sm"><?php _e('Ajustes generales del sistema.', 'hispanoargo'); ?></p>
        </div>
        <?php endif; ?>

        <!-- Ayuda -->
        <div class="dashboard-card bg-white/95 backdrop-blur-sm rounded-lg shadow-xl p-6 hover:transform hover:scale-105 transition-all cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-indigo-100 rounded-full">
                    <i class="fas fa-question-circle text-2xl text-indigo-600"></i>
                </div>
                <span class="text-sm font-semibold text-indigo-600"><?php _e('Ayuda', 'hispanoargo'); ?></span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2"><?php _e('Centro de Ayuda', 'hispanoargo'); ?></h3>
            <p class="text-gray-600 text-sm"><?php _e('Documentación y soporte del sistema.', 'hispanoargo'); ?></p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update user role display
    const userRole = document.getElementById('userRole');
    const userName = document.getElementById('userName');
    
    <?php
    $current_user = wp_get_current_user();
    if ($current_user->exists()): 
    ?>
        userName.textContent = '<?php echo esc_js($current_user->display_name); ?>';
        <?php if (current_user_can('administrator')): ?>
            userRole.textContent = '<?php _e('Administrador', 'hispanoargo'); ?>';
            userRole.classList.add('bg-blue-600');
        <?php elseif (current_user_can('editor')): ?>
            userRole.textContent = '<?php _e('Editor', 'hispanoargo'); ?>';
            userRole.classList.add('bg-green-600');
        <?php else: ?>
            userRole.textContent = '<?php _e('Visualizador', 'hispanoargo'); ?>';
            userRole.classList.add('bg-yellow-600');
        <?php endif; ?>
    <?php endif; ?>
});
</script>

<?php get_footer(); ?>
