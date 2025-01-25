<?php
/**
 * Archivo principal de la aplicación que gestiona y muestra los productos.
 *
 * Este archivo incluye la clase Principal, encargada de mostrar los
 * productos que hay en la base de datos. Además, requiere las clases
 * y vistas necesarias para la correcta visualización de los datos.
 *
 * PHP version 7.4+
 *
 * @category  WebApplication
 * @package   DAW-php-app
 * @author    Carles
 * 
 */

// Incluye el archivo que gestiona la conexión a la base de datos
require_once('Connexio.php');

// Incluye la cabecera de la aplicación (HTML, estilos, menús, etc.)
require_once('Header.php');

/**
 * Clase principal que gestiona la lista de productos.
 *
 * Esta clase contiene el método principal para mostrar los productos
 * en una tabla, incluyendo las acciones de modificar, eliminar, etc.
 */
class Principal {
    
    /**
     * Muestra la lista de productos y genera la estructura HTML.
     *
     * Este método se encarga de:
     * - Conectarse a la base de datos a través de la clase Connexio.
     * - Consultar la tabla de productos y categorías.
     * - Generar una tabla HTML con Bootstrap para mostrar el listado.
     * - Incluir enlaces para crear, modificar y eliminar productos.
     * - Incluir un footer al final de la tabla.
     *
     * @return void No devuelve nada; solo genera y muestra HTML.
     */
    public function mostrarProductes() {
        // Crea un objeto de la clase Connexio para la conexión a la base de datos
        $conexionObj = new Connexio();
        // Obtiene la instancia de conexión
        $conexion = $conexionObj->obtenirConnexio();

        // Consulta SQL para unir productos con sus categorías correspondientes
        $consulta = "SELECT p.id, p.nom, p.descripció, p.preu, c.nom as categoria
                     FROM productes p
                     INNER JOIN categories c ON p.categoria_id = c.id";
        // Ejecuta la consulta y obtiene el resultado
        $resultado = $conexion->query($consulta);

        // Inicio de la estructura HTML
        echo '<!DOCTYPE html>
              <html lang="es">
              <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <title>Llista de productes</title>
                <!-- Enlace a Bootstrap -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
              </head>
              <body>
                <div class="container mt-5" style="margin-bottom: 100px">';

        // Verifica si el resultado de la consulta contiene productos
        if ($resultado->num_rows > 0) {
            // Botón para añadir un nuevo producto
            echo '<hr><a href="Nou.php" class="btn btn-primary">Nou producte</a><hr>';

            // Inicia la tabla con clase Bootstrap
            echo '<table class="table table-striped">';
            echo '<thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Descripció</th>
                        <th>Preu</th>
                        <th>Categoria</th>
                        <th colspan="2">Accions</th>
                    </tr>
                  </thead>';
            echo '<tbody>';

            // Para numerar cada producto en la primera columna
            $i = 1;

            // Recorre los productos y genera una fila por cada uno
            while ($fila = $resultado->fetch_assoc()) {
                echo '<tr>
                        <td>' . $i . '</td>
                        <td>' . 'prod-' . $fila['id'] . '</td>
                        <td>' . $fila['nom'] . '</td>
                        <td>' . $fila['descripció'] . '</td>
                        <td>' . $fila['preu'] . '</td>
                        <td>' . $fila['categoria'] . '</td>
                        <td><a href="Modificar.php?id=' . $fila['id'] . '" class="btn btn-warning">Modificar</a></td>
                        <td><a href="Eliminar.php?id=' . $fila['id'] . '" class="btn btn-danger">Eliminar</a></td>
                      </tr>';
                $i++;
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>';

            // Incluye el Footer (pie de página)
            require_once('Footer.php');
        } else {
            // Si no hay productos, muestra un mensaje
            echo '<p>No hi ha productes.</p>';
        }

        // Cierra la conexión a la base de datos
        $conexion->close();
    }
}

// Creación de la instancia de la clase Principal y llamada al método para mostrar productos
$listaProductos = new Principal();
$listaProductos->mostrarProductes();

?>
