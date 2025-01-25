<?php
// ------------------------------------------------------
// Footer.php: Clase Footer para mostrar el pie de página
// ------------------------------------------------------

/**
 * Clase Footer que imprime la parte inferior de la página web.
 *
 * Esta clase contiene un método para mostrar el pie de página (footer),
 * con estilos de Bootstrap y scripts para funcionalidades como el carrusel.
 *
 * @category  WebApplication
 * @package   DAW-php-app
 * @author    Carles
 * @version   1.0
 */
class Footer {

   // Método para mostrar el pie de página
   /**
    * Muestra el footer HTML e incluye los scripts necesarios.
    *
    * Imprime un contenedor con texto y enlaces, y también agrega
    * los scripts de Bootstrap para el carrusel u otras funciones.
    *
    * @return void
    */
   public function mostrarFooter() {
        // Imprime el HTML del pie de página
        echo '<div class="footer text-center bg-dark text-white py-2">
                <p>&copy; 2023 CIFP Pau Casesnoves · Centro de Formación Profesional</p>
              </div>';

        // Imprime los scripts de Bootstrap desde su repositorio remoto y el script personalizado para activar el carrusel
        echo '<!-- Scripts de Bootstrap desde su repositorio remoto y script personalizado para activar el carrusel -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener(\'DOMContentLoaded\', function () {
        // Inicializar el carrusel utilizando Bootstrap
        var myCarousel = new bootstrap.Carousel(document.getElementById(\'carrusel\'), {
            interval: 2000, // Cambiar la velocidad del carrusel (en milisegundos)
            wrap: true // Repetir el carrusel al llegar al final
        });
    });
</script>';
        
        // Cierra la etiqueta </body> y </html>
        echo '</body></html>';
    }
}

// Crea una instancia de la clase Footer y llama al método mostrarFooter
$footer = new Footer();
$footer->mostrarFooter();

?>
