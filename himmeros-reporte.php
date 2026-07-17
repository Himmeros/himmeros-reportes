<?php
/**
 * The plugin bootstrap file.
 *
 * Plugin Name:       Himmeros Reporte
 * Plugin URI:        https://himmeros.xyz
 * Description:       Reportes de servicios de Proyectos Himmeros
 * Version:           0.0.2
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

// Configuro la clase que permite actualizar desde GitHub

// Incluye la librería (ajusta la ruta si es necesario)
require 'includes/plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

// Inicializa el comprobador
$myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/Himmeros/himmeros-reportes/', // URL de tu repo en GitHub
    __FILE__,                                          // Referencia a este archivo
    'himmeros-reportes'                                // Slug del plugin (debe coincidir con la carpeta)
);

// Opcional: Si tu repositorio es PRIVADO, necesitarás esto:
// $myUpdateChecker->setAuthentication('TU_TOKEN_DE_GITHUB');

class HimmerosReportes {

    public function __construct() {
        // Cargar CSS para la Portada (Frontend)
        add_action('wp_enqueue_scripts', array($this, 'cargar_css_frontend'));

        // Cargar los módulos e inicializarlos
        $this->cargar_modulos();
    }

    /**
     * Carga el archivo CSS exclusivamente en la parte pública
     */
    public function cargar_css_frontend() {
        wp_enqueue_style(
            'himmeros-reportes-portada',
            plugins_url('css/reportes-portada.css', __FILE__), // Ruta directa desde la raíz
            array(),
            '1.0.0',
            'all'
        );
    }

    /**
     * Requiere e inicializa las clases modulares del plugin
     */
    private function cargar_modulos() {
        // Definimos la ruta absoluta a los archivos de los módulos que están en includes/
        $modulo_admin_menu = plugin_dir_path(__FILE__) . 'includes/class-himmeros-reportes-admin-menu.php';
        $modulo_db = plugin_dir_path(__FILE__) . 'includes/class-himmeros-reportes-db.php'; 
        $modulo_detalles   = plugin_dir_path(__FILE__) . 'includes/class-himmeros-reportes-detalles.php';

        // 1. Cargamos la clase de base de datos primero
        if ( file_exists( $modulo_db ) ) {
            require_once $modulo_db;
        }

        // 2. Cargamos el menú
        if ( file_exists( $modulo_admin_menu ) ) {
            require_once $modulo_admin_menu;
            new HimmerosReportesAdminMenu();
        }
    }
}

// Inicializar la extensión principal
new HimmerosReportes();