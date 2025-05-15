<?php
/**
 * Template Name: Soldiers List
 * 
 * This is the template that displays the list of soldiers.
 */

// Redirect if user is not logged in
if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
    exit;
}

get_header();
?>

<div class="container mx-auto px-4 py-8">
    <div class="bg-white/95 backdrop-blur-sm rounded-lg shadow-xl p-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-users text-blue-600 mr-3"></i>
                <span data-lang="nav.soldiers"><?php _e('Listado de Soldados', 'hispanoargo'); ?></span>
            </h1>
            <?php if (!current_user_can('read_only')): ?>
            <div class="flex space-x-4">
                <button onclick="exportToExcel()" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-all">
                    <i class="fas fa-file-excel mr-2"></i>Excel
                </button>
                <button onclick="exportToPDF()" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-all">
                    <i class="fas fa-file-pdf mr-2"></i>PDF
                </button>
            </div>
            <?php endif; ?>
        </div>

        <!-- Search and Filter -->
        <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="relative">
                <input type="text" id="searchInput" placeholder="<?php esc_attr_e('Buscar soldado...', 'hispanoargo'); ?>"
                    class="w-full pl-10 pr-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>
            <select id="nationalityFilter" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500">
                <option value=""><?php _e('Todas las nacionalidades', 'hispanoargo'); ?></option>
                <?php
                $args = array(
                    'post_type' => 'soldier',
                    'posts_per_page' => -1,
                );
                $soldiers = new WP_Query($args);
                $nationalities = array();
                
                if ($soldiers->have_posts()) {
                    while ($soldiers->have_posts()) {
                        $soldiers->the_post();
                        $nationality = get_post_meta(get_the_ID(), 'nationality', true);
                        if (!empty($nationality) && !in_array($nationality, $nationalities)) {
                            $nationalities[] = $nationality;
                        }
                    }
                }
                wp_reset_postdata();

                foreach ($nationalities as $nationality) {
                    echo '<option value="' . esc_attr($nationality) . '">' . esc_html($nationality) . '</option>';
                }
                ?>
            </select>
            <select id="statusFilter" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500">
                <option value=""><?php _e('Todos los estados', 'hispanoargo'); ?></option>
                <option value="active"><?php _e('Activo', 'hispanoargo'); ?></option>
                <option value="inactive"><?php _e('Inactivo', 'hispanoargo'); ?></option>
            </select>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><?php _e('ID Militar', 'hispanoargo'); ?></th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><?php _e('Nombre', 'hispanoargo'); ?></th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><?php _e('Nacionalidad', 'hispanoargo'); ?></th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><?php _e('Código Fiscal', 'hispanoargo'); ?></th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><?php _e('Cuenta Bancaria', 'hispanoargo'); ?></th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><?php _e('Estado', 'hispanoargo'); ?></th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><?php _e('Acciones', 'hispanoargo'); ?></th>
                    </tr>
                </thead>
                <tbody id="soldiersTableBody" class="bg-white divide-y divide-gray-200">
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array(
                        'post_type' => 'soldier',
                        'posts_per_page' => 10,
                        'paged' => $paged
                    );
                    $soldiers = new WP_Query($args);

                    if ($soldiers->have_posts()) :
                        while ($soldiers->have_posts()) : $soldiers->the_post();
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
                        endwhile;
                    else:
                    ?>
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                <?php _e('No se encontraron soldados', 'hispanoargo'); ?>
                            </td>
                        </tr>
                    <?php
                    endif;
                    wp_reset_postdata();
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 flex items-center justify-between">
            <div class="text-sm text-gray-700">
                <?php
                $total_soldiers = $soldiers->found_posts;
                $per_page = $soldiers->query_vars['posts_per_page'];
                $current_page = max(1, get_query_var('paged'));
                $start = (($current_page - 1) * $per_page) + 1;
                $end = min($start + $per_page - 1, $total_soldiers);
                
                printf(
                    __('Mostrando %1$s a %2$s de %3$s resultados', 'hispanoargo'),
                    $start,
                    $end,
                    $total_soldiers
                );
                ?>
            </div>
            <div class="flex space-x-2">
                <?php
                echo paginate_links(array(
                    'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                    'format' => '?paged=%#%',
                    'current' => $current_page,
                    'total' => ceil($total_soldiers / $per_page),
                    'prev_text' => '<i class="fas fa-chevron-left"></i>',
                    'next_text' => '<i class="fas fa-chevron-right"></i>',
                    'type' => 'list'
                ));
                ?>
            </div>
        </div>
    </div>
</div>

<script>
// Delete soldier function
function deleteSoldier(id) {
    if (confirm('<?php _e('¿Está seguro de eliminar este registro?', 'hispanoargo'); ?>')) {
        jQuery.post(
            '<?php echo admin_url('admin-ajax.php'); ?>', 
            {
                action: 'delete_soldier',
                nonce: '<?php echo wp_create_nonce('delete_soldier_nonce'); ?>',
                soldier_id: id
            },
            function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert(response.data.message);
                }
            }
        );
    }
}

// Export functions
function exportToExcel() {
    window.location.href = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>?action=export_soldiers_excel&nonce=<?php echo wp_create_nonce('export_soldiers_nonce'); ?>';
}

function exportToPDF() {
    window.location.href = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>?action=export_soldiers_pdf&nonce=<?php echo wp_create_nonce('export_soldiers_nonce'); ?>';
}

// Search and filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const nationalityFilter = document.getElementById('nationalityFilter');
    const statusFilter = document.getElementById('statusFilter');

    function filterSoldiers() {
        const searchTerm = searchInput.value.toLowerCase();
        const nationality = nationalityFilter.value;
        const status = statusFilter.value;

        jQuery.post(
            '<?php echo admin_url('admin-ajax.php'); ?>',
            {
                action: 'filter_soldiers',
                nonce: '<?php echo wp_create_nonce('filter_soldiers_nonce'); ?>',
                search: searchTerm,
                nationality: nationality,
                status: status
            },
            function(response) {
                if (response.success) {
                    document.getElementById('soldiersTableBody').innerHTML = response.data.html;
                }
            }
        );
    }

    searchInput.addEventListener('input', filterSoldiers);
    nationalityFilter.addEventListener('change', filterSoldiers);
    statusFilter.addEventListener('change', filterSoldiers);
});
</script>

<?php get_footer(); ?>
