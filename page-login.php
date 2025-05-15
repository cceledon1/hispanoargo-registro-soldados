<?php
/**
 * Template Name: Login
 * 
 * This is the template that displays the login page.
 */

// Redirect if user is already logged in
if (is_user_logged_in()) {
    wp_redirect(home_url('/dashboard'));
    exit;
}

get_header();
?>

<div class="min-h-screen hero-background flex items-center justify-center">
    <!-- Language Selector -->
    <div class="fixed top-4 right-4">
        <div class="relative">
            <button id="languageButton" class="flex items-center space-x-2 px-3 py-2 rounded-md text-sm font-medium bg-white/10 hover:bg-white/20 text-white transition-all">
                <i class="fas fa-globe"></i>
                <span id="currentLanguage">ES</span>
            </button>
            <div id="languageMenu" class="hidden absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                <div class="py-1">
                    <a href="#" onclick="switchLanguage('es')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <span class="fi fi-es mr-2"></span> Español
                    </a>
                    <a href="#" onclick="switchLanguage('en')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <span class="fi fi-gb mr-2"></span> English
                    </a>
                    <a href="#" onclick="switchLanguage('uk')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <span class="fi fi-ua mr-2"></span> Українська
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="login-card max-w-md mx-auto bg-white/95 backdrop-blur-sm rounded-lg shadow-xl p-8">
            <!-- Logo y Título -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-600 text-white mb-4">
                    <i class="fas fa-shield-alt text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-800"><?php bloginfo('name'); ?></h1>
                <p class="text-gray-600 mt-2" data-lang="login.title"><?php _e('Sistema de Registro de Soldados', 'hispanoargo'); ?></p>
            </div>

            <!-- Login Form -->
            <form id="loginForm" class="space-y-6" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                <?php wp_nonce_field('hispanoargo_login', 'hispanoargo_login_nonce'); ?>
                <input type="hidden" name="action" value="hispanoargo_login">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user mr-2"></i>
                        <span data-lang="login.username"><?php _e('Usuario', 'hispanoargo'); ?></span>
                    </label>
                    <input type="text" name="username" required autocomplete="username"
                        class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                        placeholder="<?php esc_attr_e('Ingrese su usuario', 'hispanoargo'); ?>" data-lang="placeholder.username">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2"></i>
                        <span data-lang="login.password"><?php _e('Contraseña', 'hispanoargo'); ?></span>
                    </label>
                    <div class="relative">
                        <input type="password" name="password" required autocomplete="current-password"
                            class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                            placeholder="<?php esc_attr_e('Ingrese su contraseña', 'hispanoargo'); ?>" data-lang="placeholder.password">
                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                            onclick="togglePassword(this)">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center">
                        <input type="checkbox" name="rememberme" id="remember" 
                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="remember" class="ml-2 text-gray-700" data-lang="login.remember">
                            <?php _e('Recordarme', 'hispanoargo'); ?>
                        </label>
                    </div>
                    <a href="<?php echo wp_lostpassword_url(); ?>" class="text-blue-600 hover:text-blue-800" data-lang="login.forgotPassword">
                        <?php _e('¿Olvidó su contraseña?', 'hispanoargo'); ?>
                    </a>
                </div>

                <button type="submit"
                    class="w-full px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all transform hover:scale-105 active:scale-95">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    <span data-lang="login.loginButton"><?php _e('Iniciar Sesión', 'hispanoargo'); ?></span>
                </button>
            </form>

            <!-- Error Messages -->
            <?php if (isset($_GET['login']) && $_GET['login'] == 'failed'): ?>
            <div id="errorMessage" class="mt-4 p-3 bg-red-100 text-red-700 rounded-md text-sm">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span data-lang="login.error"><?php _e('Usuario o contraseña incorrectos', 'hispanoargo'); ?></span>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// Toggle password visibility
function togglePassword(button) {
    const input = button.parentElement.querySelector('input');
    const icon = button.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Form submission
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('button[type="submit"]');
    
    // Show loading state
    submitBtn.disabled = true;
    submitBtn.innerHTML = `<i class="fas fa-spinner fa-spin mr-2"></i><span data-lang="login.verifying"><?php _e('Verificando...', 'hispanoargo'); ?></span>`;
});

// Language menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const languageButton = document.getElementById('languageButton');
    const languageMenu = document.getElementById('languageMenu');
    
    languageButton.addEventListener('click', () => {
        languageMenu.classList.toggle('hidden');
    });

    // Close language menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!languageButton.contains(e.target) && !languageMenu.contains(e.target)) {
            languageMenu.classList.add('hidden');
        }
    });

    // Update current language display
    const currentLang = localStorage.getItem('preferredLanguage') || 'es';
    document.getElementById('currentLanguage').textContent = currentLang.toUpperCase();
});
</script>

<?php get_footer(); ?>
