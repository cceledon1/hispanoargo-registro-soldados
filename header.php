<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class('min-h-screen hero-background'); ?>>
    <nav class="bg-gray-900 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-shield-alt text-2xl text-yellow-500"></i>
                    <span class="ml-3 text-xl font-bold"><?php bloginfo('name'); ?></span>
                    <span id="userRole" class="ml-3 px-2 py-1 text-xs rounded-full"></span>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button id="languageButton" class="flex items-center space-x-2 px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">
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
                    <a href="<?php echo esc_url(home_url('/dashboard')); ?>" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700" data-lang="nav.home">Inicio</a>
                    <a href="<?php echo esc_url(home_url('/soldiers')); ?>" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700" data-lang="nav.soldiers">Soldados</a>
                    <a href="<?php echo esc_url(home_url('/admin')); ?>" id="btnAdmin" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700" data-lang="nav.admin">Admin</a>
                    <div class="flex items-center space-x-2">
                        <span id="userName" class="text-sm text-gray-300"></span>
                        <button onclick="logout()" class="bg-red-600 px-4 py-2 rounded-md text-sm font-medium hover:bg-red-700 transition-all">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            <span data-lang="nav.logout">Salir</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
