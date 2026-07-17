<?php
/**
 * The plugin bootstrap file.
 *
 * Plugin Name:       Himmeros Reporte
 * Plugin URI:        https://himmeros.xyz
 * Description:       Reportes de servicios de Proyectos Himmeros
 * Version:           0.0.3
 *
 * Author:            Proyectos Himmeros
 * Author URI:        https://himmeros.xyz
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * Requires at least: 6.7
 * Requires PHP:      7.4
 *
 * Text Domain:       himmeros-reporte
 */

defined( 'ABSPATH' ) || exit;

// -----------------------------------------------------------------------------
// 1. CONFIGURACIÓN DE ACTUALIZACIONES AUTOMÁTICAS (GitHub)
// -----------------------------------------------------------------------------

// Usamos plugin_dir_path para asegurar que siempre encuentre la carpeta sin importar el entorno
require_once plugin_dir_path( __FILE__ ) . 'includes/plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/Himmeros/himmeros-reportes/', 
    __FILE__,                                          
    'himmeros-reportes'                                
);

// -----------------------------------------------------------------------------
// 2. CLASE PRINCIPAL DEL PLUGIN
// -----------------------------------------------------------------------------

class HimmerosReportes {

    public function __construct() {
        // Cargar CSS para el frontend
        add_action( 'wp_enqueue_scripts', array( $this, 'cargar_css_frontend' ) );

        // Cargar los módulos e inicializarlos
        $this->cargar_modulos();
    }

    /**
     * Carga el archivo CSS exclusivamente en la parte pública (Frontend)
     */
    public function cargar_css_frontend() {
        // Registra y carga tu CSS de assets (Asegúrate de que esta carpeta exista)
        wp_enqueue_style(
            'himmeros-reportes-frontend-style',
            plugins_url( 'assets/css/himmeros-frontend.css', __FILE__ ),
            array(),
            '0.0.3', // Es buena práctica enlazar esto a la versión de tu plugin
            'all'
        );
    }

    /**
     * Requiere e inicializa las clases modulares del plugin
     */
    public function cargar_modulos() {
        
        // 1. Requerir archivos MVC y el Shortcode
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-himmeros-reportes-db.php';
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-himmeros-reportes-controller.php';
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-himmeros-reportes-detalles.php';
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-himmeros-reportes-shortcode.php';

        // 2. Inicializar el Shortcode (El constructor de esta clase registrará el shortcode)
        if ( class_exists( 'Himmeros_Reportes_Shortcode' ) ) {
            new Himmeros_Reportes_Shortcode();
        }

        // 3. Requerir e inicializar el menú de admin
        $modulo_admin_menu = plugin_dir_path( __FILE__ ) . 'includes/class-himmeros-reportes-admin-menu.php';
        if ( file_exists( $modulo_admin_menu ) ) {
            require_once $modulo_admin_menu;
            if ( class_exists( 'HimmerosReportesAdminMenu' ) ) {
                new HimmerosReportesAdminMenu();
            }
        }
    }
}

// Inicializar la extensión principal
new HimmerosReportes();