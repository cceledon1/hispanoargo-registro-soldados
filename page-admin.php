<?php
/**
 * Template Name: Admin Panel
 * 
 * This is the template that displays the admin panel.
 */

// Redirect if user is not administrator
if (!current_user_can('administrator')) {
    wp_redirect(home_url());
    exit;
}

get_header();
?>

<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Gestión de Usuarios -->
        <div class="admin-card bg-white/95 backdrop-blur-sm rounded-lg shadow-xl p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-users-cog text-blue-600 mr-3"></i>
                <?php _e('Gestión de Usuarios', 'hispanoargo'); ?>
            </h2>
            
            <!-- Formulario de Usuario -->
            <form id="userForm" class="space-y-4 mb-6">
                <?php wp_nonce_field('create_user_nonce', 'create_user_nonce'); ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><?php _e('Usuario', 'hispanoargo'); ?></label>
                        <input type="text" name="username" required 
                            class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><?php _e('Contraseña', 'hispanoargo'); ?></label>
                        <input type="password" name="password" required 
                            class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><?php _e('Email', 'hispanoargo'); ?></label>
                        <input type="email" name="email" required 
                            class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><?php _e('Rol', 'hispanoargo'); ?></label>
                        <select name="role" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500">
                            <option value=""><?php _e('Seleccionar rol...', 'hispanoargo'); ?></option>
                            <option value="administrator"><?php _e('Administrador', 'hispanoargo'); ?></option>
                            <option value="editor"><?php _e('Editor', 'hispanoargo'); ?></option>
                            <option value="read_only"><?php _e('Visualizador', 'hispanoargo'); ?></option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all">
                            <i class="fas fa-user-plus mr-2"></i><?php _e('Agregar Usuario', 'hispanoargo'); ?>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Lista de Usuarios -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><?php _e('Usuario', 'hispanoargo'); ?></th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><?php _e('Email', 'hispanoargo'); ?></th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><?php _e('Rol', 'hispanoargo'); ?></th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><?php _e('Acciones', 'hispanoargo'); ?></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="usersList">
                        <?php
                        $users = get_users();
                        foreach ($users as $user) :
                            $roles = array_values($user->roles);
                            $role = !empty($roles) ? $roles[0] : '';
                        ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="fas fa-user text-gray-400 mr-2"></i>
                                        <?php echo esc_html($user->user_login); ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php echo esc_html($user->user_email); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs rounded-full <?php
                                        echo $role === 'administrator' ? 'bg-blue-100 text-blue-800' :
                                            ($role === 'editor' ? 'bg-green-100 text-green-800' :
                                            'bg-yellow-100 text-yellow-800');
                                    ?>">
                                        <?php
                                        echo $role === 'administrator' ? __('Administrador', 'hispanoargo') :
                                            ($role === 'editor' ? __('Editor', 'hispanoargo') :
                                            __('Visualizador', 'hispanoargo'));
                                        ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <?php if ($user->ID !== get_current_user_id()): ?>
                                        <button class="text-red-600 hover:text-red-900" 
                                                onclick="deleteUser(<?php echo $user->ID; ?>)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- System Settings -->
        <div class="admin-card bg-white/95 backdrop-blur-sm rounded-lg shadow-xl p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-cog text-green-600 mr-3"></i>
                <?php _e('Configuración del Sistema', 'hispanoargo'); ?>
            </h2>

            <form id="settingsForm" class="space-y-6">
                <?php wp_nonce_field('update_settings_nonce', 'update_settings_nonce'); ?>
                
                <!-- Email Settings -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-700"><?php _e('Configuración de Email', 'hispanoargo'); ?></h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <?php _e('Email de Notificaciones', 'hispanoargo'); ?>
                        </label>
                        <input type="email" name="notification_email" 
                               value="<?php echo esc_attr(get_option('hispanoargo_notification_email')); ?>"
                               class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Language Settings -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-700"><?php _e('Configuración de Idioma', 'hispanoargo'); ?></h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <?php _e('Idioma por Defecto', 'hispanoargo'); ?>
                        </label>
                        <select name="default_language" 
                                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500">
                            <option value="es" <?php selected(get_option('hispanoargo_default_language'), 'es'); ?>>
                                <?php _e('Español', 'hispanoargo'); ?>
                            </option>
                            <option value="en" <?php selected(get_option('hispanoargo_default_language'), 'en'); ?>>
                                <?php _e('English', 'hispanoargo'); ?>
                            </option>
                            <option value="uk" <?php selected(get_option('hispanoargo_default_language'), 'uk'); ?>>
                                <?php _e('Українська', 'hispanoargo'); ?>
                            </option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-all">
                    <i class="fas fa-save mr-2"></i><?php _e('Guardar Configuración', 'hispanoargo'); ?>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    // Add User
    $('#userForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {
                action: 'create_user',
                nonce: $('#create_user_nonce').val(),
                username: $('input[name="username"]').val(),
                password: $('input[name="password"]').val(),
                email: $('input[name="email"]').val(),
                role: $('select[name="role"]').val()
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert(response.data.message);
                }
            }
        });
    });

    // Delete User
    window.deleteUser = function(userId) {
        if (confirm('<?php _e('¿Está seguro de eliminar este usuario?', 'hispanoargo'); ?>')) {
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'delete_user',
                    nonce: '<?php echo wp_create_nonce('delete_user_nonce'); ?>',
                    user_id: userId
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert(response.data.message);
                    }
                }
            });
        }
    };

    // Update Settings
    $('#settingsForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {
                action: 'update_settings',
                nonce: $('#update_settings_nonce').val(),
                notification_email: $('input[name="notification_email"]').val(),
                default_language: $('select[name="default_language"]').val()
            },
            success: function(response) {
                if (response.success) {
                    alert('<?php _e('Configuración guardada exitosamente', 'hispanoargo'); ?>');
                } else {
                    alert(response.data.message);
                }
            }
        });
    });
});
</script>

<?php get_footer(); ?>
