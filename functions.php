<?php
function hispanoargo_enqueue_scripts() {
    wp_enqueue_style('tailwind', 'https://cdn.tailwindcss.com');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
    wp_enqueue_style('hispanoargo-style', get_stylesheet_uri());
    wp_enqueue_script('languages', get_template_directory_uri() . '/languages.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'hispanoargo_enqueue_scripts');

function hispanoargo_register_post_types() {
    $labels = array(
        'name' => __('Soldiers', 'hispanoargo'),
        'singular_name' => __('Soldier', 'hispanoargo'),
        'add_new' => __('Add New Soldier', 'hispanoargo'),
        'add_new_item' => __('Add New Soldier', 'hispanoargo'),
        'edit_item' => __('Edit Soldier', 'hispanoargo'),
        'new_item' => __('New Soldier', 'hispanoargo'),
        'view_item' => __('View Soldier', 'hispanoargo'),
        'search_items' => __('Search Soldiers', 'hispanoargo'),
        'not_found' => __('No soldiers found', 'hispanoargo'),
        'not_found_in_trash' => __('No soldiers found in Trash', 'hispanoargo'),
        'all_items' => __('All Soldiers', 'hispanoargo'),
        'menu_name' => __('Soldiers', 'hispanoargo'),
        'name_admin_bar' => __('Soldier', 'hispanoargo'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_in_menu' => true,
        'supports' => array('title', 'editor', 'custom-fields'),
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'soldiers'),
        'show_in_rest' => true,
    );

    register_post_type('soldier', $args);
}
add_action('init', 'hispanoargo_register_post_types');

// AJAX handler to delete soldier
function hispanoargo_delete_soldier() {
    check_ajax_referer('delete_soldier_nonce', 'nonce');

    if (!current_user_can('delete_posts')) {
        wp_send_json_error(array('message' => __('No tienes permisos para eliminar registros.', 'hispanoargo')));
    }

    $soldier_id = intval($_POST['soldier_id']);
    if (get_post_type($soldier_id) !== 'soldier') {
        wp_send_json_error(array('message' => __('Registro inválido.', 'hispanoargo')));
    }

    $deleted = wp_delete_post($soldier_id, true);
    if ($deleted) {
        wp_send_json_success();
    } else {
        wp_send_json_error(array('message' => __('Error al eliminar el registro.', 'hispanoargo')));
    }
}
add_action('wp_ajax_delete_soldier', 'hispanoargo_delete_soldier');

// AJAX handler to filter soldiers
function hispanoargo_filter_soldiers() {
    check_ajax_referer('filter_soldiers_nonce', 'nonce');

    $search = sanitize_text_field($_POST['search']);
    $nationality = sanitize_text_field($_POST['nationality']);
    $status = sanitize_text_field($_POST['status']);

    $meta_query = array('relation' => 'AND');

    if (!empty($nationality)) {
        $meta_query[] = array(
            'key' => 'nationality',
            'value' => $nationality,
            'compare' => '='
        );
    }

    if (!empty($status)) {
        $meta_query[] = array(
            'key' => 'status',
            'value' => $status,
            'compare' => '='
        );
    }

    $args = array(
        'post_type' => 'soldier',
        'posts_per_page' => -1,
        'meta_query' => $meta_query,
        's' => $search
    );

    $query = new WP_Query($args);

    ob_start();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $military_id = get_post_meta(get_the_ID(), 'military_id', true);
            $nickname = get_post_meta(get_the_ID(), 'nickname', true);
            $nationality = get_post_meta(get_the_ID(), 'nationality', true);
            $fiscal_code = get_post_meta(get_the_ID(), 'fiscal_code', true);
            $bank_account = get_post_meta(get_the_ID(), 'bank_account', true);
            $status = get_post_meta(get_the_ID(), 'status', true);
            ?>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900"><?php echo esc_html($military_id); ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900"><?php the_title(); ?></div>
                    <div class="text-sm text-gray-500"><?php echo esc_html($nickname); ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="fi fi-<?php echo strtolower($nationality); ?> mr-2"></span>
                    <?php echo esc_html($nationality); ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900"><?php echo esc_html($fiscal_code); ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900"><?php echo esc_html($bank_account); ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 text-xs rounded-full <?php echo $status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                        <?php echo $status === 'active' ? __('Activo', 'hispanoargo') : __('Inactivo', 'hispanoargo'); ?>
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm flex items-center space-x-2">
                    <a href="<?php echo esc_url(add_query_arg('mode', 'view', get_permalink())); ?>" class="text-blue-600 hover:text-blue-900" title="<?php esc_attr_e('Ver', 'hispanoargo'); ?>">
                        <i class="fas fa-eye"></i>
                    </a>
                    <?php if (current_user_can('edit_posts')): ?>
                    <a href="<?php echo esc_url(add_query_arg('mode', 'edit', get_permalink())); ?>" class="text-green-600 hover:text-green-900" title="<?php esc_attr_e('Editar', 'hispanoargo'); ?>">
                        <i class="fas fa-edit"></i>
                    </a>
                    <?php endif; ?>
                    <?php if (current_user_can('delete_posts')): ?>
                    <button onclick="deleteSoldier(<?php echo get_the_ID(); ?>)" class="text-red-600 hover:text-red-900" title="<?php esc_attr_e('Eliminar', 'hispanoargo'); ?>">
                        <i class="fas fa-trash"></i>
                    </button>
                    <?php endif; ?>
                </td>
            </tr>
            <?php
        }
    } else {
        echo '<tr><td colspan="7" class="px-6 py-4 text-center text-gray-500">' . __('No se encontraron soldados', 'hispanoargo') . '</td></tr>';
    }
    wp_reset_postdata();

    $html = ob_get_clean();
    wp_send_json_success(array('html' => $html));
}
add_action('wp_ajax_filter_soldiers', 'hispanoargo_filter_soldiers');

// Handle login form submission
function hispanoargo_handle_login() {
    if (!isset($_POST['hispanoargo_login_nonce']) || !wp_verify_nonce($_POST['hispanoargo_login_nonce'], 'hispanoargo_login')) {
        wp_redirect(add_query_arg('login', 'failed', wp_login_url()));
        exit;
    }

    $username = sanitize_user($_POST['username']);
    $password = $_POST['password'];
    $remember = isset($_POST['rememberme']);

    $user = wp_signon(array(
        'user_login' => $username,
        'user_password' => $password,
        'remember' => $remember
    ));

    if (is_wp_error($user)) {
        wp_redirect(add_query_arg('login', 'failed', wp_login_url()));
        exit;
    }

    wp_redirect(home_url('/dashboard'));
    exit;
}
add_action('admin_post_hispanoargo_login', 'hispanoargo_handle_login');
add_action('admin_post_nopriv_hispanoargo_login', 'hispanoargo_handle_login');

// AJAX handler for user creation
function hispanoargo_create_user() {
    check_ajax_referer('create_user_nonce', 'nonce');

    if (!current_user_can('create_users')) {
        wp_send_json_error(array('message' => __('No tienes permisos para crear usuarios.', 'hispanoargo')));
    }

    $username = sanitize_user($_POST['username']);
    $password = $_POST['password'];
    $email = sanitize_email($_POST['email']);
    $role = sanitize_text_field($_POST['role']);

    // Validate role
    $allowed_roles = array('administrator', 'editor', 'read_only');
    if (!in_array($role, $allowed_roles)) {
        wp_send_json_error(array('message' => __('Rol inválido.', 'hispanoargo')));
    }

    // Create user
    $user_id = wp_create_user($username, $password, $email);
    if (is_wp_error($user_id)) {
        wp_send_json_error(array('message' => $user_id->get_error_message()));
    }

    // Set role
    $user = new WP_User($user_id);
    $user->set_role($role);

    wp_send_json_success();
}
add_action('wp_ajax_create_user', 'hispanoargo_create_user');

// AJAX handler for user deletion
function hispanoargo_delete_user() {
    check_ajax_referer('delete_user_nonce', 'nonce');

    if (!current_user_can('delete_users')) {
        wp_send_json_error(array('message' => __('No tienes permisos para eliminar usuarios.', 'hispanoargo')));
    }

    $user_id = intval($_POST['user_id']);
    
    // Prevent self-deletion
    if ($user_id === get_current_user_id()) {
        wp_send_json_error(array('message' => __('No puedes eliminarte a ti mismo.', 'hispanoargo')));
    }

    // Delete user
    $deleted = wp_delete_user($user_id);
    if ($deleted) {
        wp_send_json_success();
    } else {
        wp_send_json_error(array('message' => __('Error al eliminar el usuario.', 'hispanoargo')));
    }
}
add_action('wp_ajax_delete_user', 'hispanoargo_delete_user');

// AJAX handler for settings update
function hispanoargo_update_settings() {
    check_ajax_referer('update_settings_nonce', 'nonce');

    if (!current_user_can('manage_options')) {
        wp_send_json_error(array('message' => __('No tienes permisos para actualizar la configuración.', 'hispanoargo')));
    }

    $notification_email = sanitize_email($_POST['notification_email']);
    $default_language = sanitize_text_field($_POST['default_language']);

    // Validate language
    $allowed_languages = array('es', 'en', 'uk');
    if (!in_array($default_language, $allowed_languages)) {
        wp_send_json_error(array('message' => __('Idioma inválido.', 'hispanoargo')));
    }

    // Update settings
    update_option('hispanoargo_notification_email', $notification_email);
    update_option('hispanoargo_default_language', $default_language);

    wp_send_json_success();
}
add_action('wp_ajax_update_settings', 'hispanoargo_update_settings');

// Export functions
function hispanoargo_export_soldiers_excel() {
    check_admin_referer('export_soldiers_nonce', 'nonce');

    if (!current_user_can('edit_posts')) {
        wp_die(__('No tienes permisos para exportar registros.', 'hispanoargo'));
    }

    $args = array(
        'post_type' => 'soldier',
        'posts_per_page' => -1,
    );
    $soldiers = get_posts($args);

    // Set headers for Excel download
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=soldados.csv');

    $output = fopen('php://output', 'w');
    
    // Add UTF-8 BOM for Excel
    fputs($output, "\xEF\xBB\xBF");

    // Headers
    fputcsv($output, array(
        'ID Militar',
        'Nombre Completo',
        'Apodo',
        'Nacionalidad',
        'Teléfono',
        'Grupo Sanguíneo',
        'Código Fiscal',
        'Cuenta Bancaria',
        'Estado'
    ));

    // Data
    foreach ($soldiers as $soldier) {
        fputcsv($output, array(
            get_post_meta($soldier->ID, 'military_id', true),
            $soldier->post_title,
            get_post_meta($soldier->ID, 'nickname', true),
            get_post_meta($soldier->ID, 'nationality', true),
            get_post_meta($soldier->ID, 'phone', true),
            get_post_meta($soldier->ID, 'blood_type', true),
            get_post_meta($soldier->ID, 'fiscal_code', true),
            get_post_meta($soldier->ID, 'bank_account', true),
            get_post_meta($soldier->ID, 'status', true)
        ));
    }

    fclose($output);
    exit;
}
add_action('wp_ajax_export_soldiers_excel', 'hispanoargo_export_soldiers_excel');

// Add custom roles on theme activation
function hispanoargo_add_roles() {
    add_role('read_only', __('Visualizador', 'hispanoargo'), array(
        'read' => true,
        'read_private_posts' => true
    ));
}
add_action('after_switch_theme', 'hispanoargo_add_roles');

// Remove custom roles on theme deactivation
function hispanoargo_remove_roles() {
    remove_role('read_only');
}
add_action('switch_theme', 'hispanoargo_remove_roles');

?>
