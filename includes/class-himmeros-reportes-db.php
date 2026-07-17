<?php
// includes/class-himmeros-reportes-db.php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Seguridad inicial [cite: 62]
}

class HimmerosReportesDB {

    // Variable para almacenar el nombre de tu tabla con el prefijo correcto de WP
    private $tabla_reportes;

    public function __construct() {
        global $wpdb;
        // Si vas a crear una tabla propia, usamos el prefijo nativo de WP (ej. wp_himmeros_reportes)
        $this->tabla_reportes = $wpdb->prefix . 'himmeros_reportes';
    }

    /**
     * Función de ejemplo para LEER datos (Read)
     */
    public function obtener_todos_los_reportes() {
        global $wpdb;
        
        // Ejecutamos una consulta segura
        $resultados = $wpdb->get_results( "SELECT * FROM {$this->tabla_reportes} ORDER BY fecha DESC" );
        
        return $resultados;
    }

    /**
     * Función de ejemplo para GUARDAR datos (Create)
     */
    public function guardar_reporte( $datos ) {
        global $wpdb;

        // $wpdb->insert sanitiza automáticamente los datos por seguridad
        $wpdb->insert(
            $this->tabla_reportes,
            array(
                'cliente_id' => $datos['cliente_id'],
                'detalles'   => $datos['detalles'],
                'fecha'      => current_time('mysql')
            )
        );

        return $wpdb->insert_id; // Devuelve el ID del nuevo reporte
    }
}