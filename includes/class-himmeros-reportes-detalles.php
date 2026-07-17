<?php
// includes/class-himmeros-reportes-detalles.php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Seguridad: Evitar acceso directo
}

class HimmerosReportesDetalles {

    public function __construct() {
        // Aquí en el futuro puedes inicializar variables,
        // o instanciar tu clase de Base de Datos si necesitas extraer info
    }

    /**
     * Renderiza el contenido HTML de la pestaña "01 Detalles"
     */
    public function renderizar_vista() {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            
            <div class="caja-reporte">
                <h3>Detalles del Sistema de Reportes</h3>
                <h4>Implementado para <b>Proyectos Himmeros</b></h4>
                <hr/>
                <p>La idea es llevar un registro detallado del servicio proporcionado a los clientes .</p>
                
                <div class="detalles-grid">
                    <p><strong>Estado del sistema:</strong> Activo</p>
                    <p><strong>Versión:</strong> 0.0.2</p>
                </div>
            </div>
        </div>
        <?php
    }
}