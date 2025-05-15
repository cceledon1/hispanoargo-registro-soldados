<!-- Footer -->
    <footer class="bg-gray-900 text-white mt-12">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('Todos los derechos reservados.', 'hispanoargo'); ?></p>
                </div>
                <div class="flex space-x-4">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-menu',
                        'container' => false,
                        'menu_class' => 'flex space-x-4',
                        'fallback_cb' => function() {
                            echo '<a href="#" class="text-sm hover:text-gray-300">' . __('Términos y Condiciones', 'hispanoargo') . '</a>';
                            echo '<a href="#" class="text-sm hover:text-gray-300">' . __('Política de Privacidad', 'hispanoargo') . '</a>';
                        }
                    ));
                    ?>
                </div>
            </div>
        </div>
    </footer>

    <script>
    // Language menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        const languageButton = document.getElementById('languageButton');
        const languageMenu = document.getElementById('languageMenu');
        
        if (languageButton && languageMenu) {
            languageButton.addEventListener('click', () => {
                languageMenu.classList.toggle('hidden');
            });

            // Close language menu when clicking outside
            document.addEventListener('click', (e) => {
                if (!languageButton.contains(e.target) && !languageMenu.contains(e.target)) {
                    languageMenu.classList.add('hidden');
                }
            });
        }

        // Update current language display
        const currentLang = localStorage.getItem('preferredLanguage') || 'es';
        const currentLanguageElement = document.getElementById('currentLanguage');
        if (currentLanguageElement) {
            currentLanguageElement.textContent = currentLang.toUpperCase();
        }

        // Initialize language
        if (typeof updatePageLanguage === 'function') {
            updatePageLanguage();
        }
    });

    // Logout function
    function logout() {
        window.location.href = '<?php echo wp_logout_url(home_url()); ?>';
    }
    </script>

    <?php wp_footer(); ?>
</body>
</html>
