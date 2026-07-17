<?php
// includes/class-himmeros-reportes-admin-menu.php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class HimmerosReportesAdminMenu {

    public function __construct() {
        // Hook para crear el menú y submenús de administración [cite: 64]
        add_action('admin_menu', array($this, 'crear_menu_administracion'));

        // Registramos el CSS del admin [cite: 64]
        add_action('admin_enqueue_scripts', array($this, 'cargar_css_backend'));
    }

    public function cargar_css_backend() {
        wp_enqueue_style(
            'himmeros-reportes-admin',
            plugins_url('../css/reportes-admin.css', __FILE__), 
            array(),
            '1.0.0',
            'all'
        );
    }

    /**
     * Registra el menú principal y sus submenús
     */
    public function crear_menu_administracion() {
        // 1. Crear el menú principal padre
        add_menu_page(
            'Himmeros Reportes',          
            'Himmeros Reportes',          
            'manage_options',             
            'himmeros-reportes',          // Slug padre
            array($this, 'renderizar_pagina_detalles'), // Callback principal
            'dashicons-chart-bar',        
            25                            
        );

        // 2. Submenú 01: Detalles (Sobrescribe el primer enlace por defecto)
        add_submenu_page(
            'himmeros-reportes',          // Slug del padre
            'Detalles del Sistema',       // Título de la página
            '01 Detalles',                // Título del menú
            'manage_options',             // Capacidad
            'himmeros-reportes',          // Mismo slug que el padre para que sea el primero
            array($this, 'renderizar_pagina_detalles') 
        );

        // 3. Submenú 02: Reportes
        add_submenu_page(
            'himmeros-reportes',          
            'Listado de Reportes',        
            '02 Reportes',                
            'manage_options',             
            'himmeros-reportes-lista',    // Nuevo slug
            array($this, 'renderizar_pagina_reportes') 
        );

        // 4. Submenú 03: Clientes
        add_submenu_page(
            'himmeros-reportes',          
            'Gestión de Clientes',        
            '03 Clientes',                
            'manage_options',             
            'himmeros-reportes-clientes', // Nuevo slug
            array($this, 'renderizar_pagina_clientes') 
        );

        // 5. Submenú 04: Configuración
        add_submenu_page(
            'himmeros-reportes',          
            'Configuración de Reportes',  
            '04 Configuración',           
            'manage_options',             
            'himmeros-reportes-config',   // Nuevo slug
            array($this, 'renderizar_pagina_configuracion') 
        );
    }

    /**
     * Callbacks para renderizar el HTML de cada página
     */

    public function renderizar_pagina_detalles() {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <div class="caja-reporte">
                <h3>Detalles del Sistema</h3>
                <p>Aquí irá la información general y detalles de la extensión.</p>
            </div>
        </div>
        <?php
    }

    public function renderizar_pagina_reportes() {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <div class="caja-reporte">
                <h3>Listado de Reportes</h3>
                <p>Aquí mostraremos la tabla o listado de reportes generados.</p>
            </div>
        </div>
        <?php
    }

    public function renderizar_pagina_clientes() {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <div class="caja-reporte">
                <h3>Directorio de Clientes</h3>
                <p>Aquí irá la gestión o el listado de clientes asociados a los reportes.</p>
            </div>
        </div>
        <?php
    }

    public function renderizar_pagina_configuracion() {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <div class="caja-reporte">
                <h3>Configuración General</h3>
                <p>Aquí pondremos los ajustes, formularios y preferencias del plugin.</p>
            </div>
        </div>
        <?php
    }
}