<?php
/**
 * Clase Connexio que gestiona la conexión a la base de datos la_meva_botiga.
 *
 * Esta clase encapsula los datos de conexión (host, usuario, contraseña y nombre de la BD)
 * y proporciona un método para obtener una conexión mysqli.
 *
 * @category  WebApplication
 * @package   DAW-php-app
 * @author    Carles
 * @version   1.0
 */
class Connexio {
    //Dades de la connexió a la base de dades la_meva_botiga.
    private $host = "localhost";
    private $usuario = "root";
    private $contraseña = "";
    private $baseDatos = "la_meva_botiga";

    /**
     * Obtiene la conexión a la base de datos.
     *
     * Crea una instancia de mysqli con los datos privados de la clase.
     * Si ocurre un error, detiene la ejecución y muestra el mensaje de error.
     *
     * @return mysqli Objeto de conexión a la base de datos.
     */
    public function obtenirConnexio() {
        // Crea un nuevo objeto mysqli utilizando los datos de conexión
        $conexion = new mysqli($this->host, $this->usuario, $this->contraseña, $this->baseDatos);

        // Verifica si ha ocurrido algún error al conectar
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Devuelve el objeto mysqli válido para interactuar con la BD
        return $conexion;
    }
}

?>
