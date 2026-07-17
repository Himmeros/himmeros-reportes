<?php
defined( 'ABSPATH' ) || exit;

class Himmeros_Reportes_Shortcode {
    
    public function __construct() {
        // Registramos el shortcode de WordPress
        add_shortcode( 'himmeros_reporte_detalles', array( $this, 'renderizar_shortcode' ) );
    }

    public function renderizar_shortcode() {
        // REUTILIZACIÓN MVC: Llamamos exactamente al mismo controlador
        $controller = new Himmeros_Reportes_Controller();
        $registros = $controller->procesar_detalles();

        // Iniciamos el búfer para capturar el HTML sin renderizarlo antes de tiempo
        ob_start();
        ?>
        
        <div class="himmeros-reporte-frontend">
            <h3 class="himmeros-titulo">Reporte de Clientes Himmeros</h3>
            
            <div class="himmeros-tabla-contenedor">
                <table class="himmeros-tabla">
                    <thead>
                        <tr>
                            <th>Correlativo</th>
                            <th>Nombre Cliente</th>
                            <th>R.I.F.</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty( $registros ) ) : ?>
                            <?php foreach ( $registros as $fila ) : ?>
                                <tr>
                                    <td data-label="Correlativo"><?php echo esc_html( $fila->correlativo ); ?></td>
                                    <td data-label="Nombre Cliente"><strong><?php echo esc_html( $fila->nombre_cliente ); ?></strong></td>
                                    <td data-label="R.I.F."><?php echo esc_html( $fila->rif ); ?></td>
                                    <td data-label="Correo"><a href="mailto:<?php echo esc_attr( $fila->correo ); ?>"><?php echo esc_html( $fila->correo ); ?></a></td>
                                    <td data-label="Teléfono"><?php echo esc_html( $fila->telefono ); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="sin-registros">No hay registros disponibles.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <?php
        // Retornamos todo el HTML capturado
        return ob_get_clean();
    }
}