<?php
/**
 * Archivo Actualitzar.
 *
 * Este archivo contiene la clase Actualitzar que se encarga de procesar la
 * actualización de productos en la base de datos. También recoge los valores
 * enviados por el formulario y llama al método correspondiente.
 *
 * @category  WebApplication
 * @package   DAW-php-app
 * @author    Carles
 * @version   1.0
 */

// Incluye el archivo de conexión
require_once('Connexio.php');

/**
 * Clase Actualitzar que gestiona la actualización de productos en la base de datos.
 *
 * Proporciona el método actualizar, que recibe los datos de un producto, los
 * valida y los aplica en la tabla 'productes'.
 */
class Actualitzar {
    
    /**
     * Actualiza un producto en la base de datos.
     *
     * @param mixed $id         ID del producto a actualizar.
     * @param mixed $nom        Nombre del producto.
     * @param mixed $descripcio Descripción del producto.
     * @param mixed $preu       Precio del producto.
     * @param mixed $categoria  ID de la categoría a la que pertenece el producto.
     *
     * @return void Imprime mensajes de error si faltan campos o si ocurre
     *              un fallo al ejecutar la consulta.
     */
    public function actualizar($id, $nom, $descripcio, $preu, $categoria) {
        // Verifica si todos los campos requeridos están presentes
        if (!isset($id) || !isset($nom) || !isset($descripcio) || !isset($preu) || !isset($categoria)) {
            echo '<p>Se requieren todos los campos para actualizar el producto.</p>';
            return;
        }

        // Crea una instancia de la clase de conexión
        $conexionObj = new Connexio();
        // Obtiene la conexión a la base de datos
        $conexion = $conexionObj->obtenirConnexio();

        // Escapa las variables para prevenir SQL injection
        $id = $conexion->real_escape_string($id);
        $nom = $conexion->real_escape_string($nom);
        $descripcio = $conexion->real_escape_string($descripcio);
        $preu = $conexion->real_escape_string($preu);
        $categoria = $conexion->real_escape_string($categoria);

        // Construye la consulta SQL de actualización
        $consulta = "UPDATE productes
                     SET nom = '$nom', descripció = '$descripcio', preu = '$preu', categoria_id = '$categoria'
                     WHERE id = '$id'";

        // Ejecuta la consulta y redirige a la página principal si tiene éxito
        if ($conexion->query($consulta) === TRUE) {
            header('Location: Principal.php');
            exit();
        } else {
            // Muestra un mensaje de error si la consulta falla
            echo '<p>Error al actualizar el producto: ' . $conexion->error . '</p>';
        }

        // Cierra la conexión a la base de datos
        $conexion->close();
    }
}

// Obtiene los valores del formulario (si existen)
$id = isset($_POST['id']) ? $_POST['id'] : null;
$nom = isset($_POST['nom']) ? $_POST['nom'] : null;
$descripcio = isset($_POST['descripcio']) ? $_POST['descripcio'] : null;
$preu = isset($_POST['preu']) ? $_POST['preu'] : null;
$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;

// Crea una instancia de la clase Actualitzar y llama al método actualizar
$actualizarProducto = new Actualitzar();
$actualizarProducto->actualizar($id, $nom, $descripcio, $preu, $categoria);

?>
