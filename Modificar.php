<?php
// ------------------------------------------------------
// Inicio del código PHP
// ------------------------------------------------------

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
 */

// ------------------------------------------------------
// Carga de archivos requeridos
// ------------------------------------------------------

// Incluye el archivo que gestiona la conexión a la base de datos.
// Contiene la clase Connexio, que provee el método obtenirConnexio().
require_once('Connexio.php');

// Incluye la cabecera de la aplicación (HTML, estilos, menús, etc.)
// El archivo Header.php suele contener el encabezado común para todas las páginas.
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
        // ------------------------------------------------------
        // 1. Obtenemos la conexión a la base de datos
        // ------------------------------------------------------
        $conexionObj = new Connexio();              // Instancia la clase de conexión
        $conexion = $conexionObj->obtenirConnexio(); // Llama al método que devuelve la conexión activa

        // ------------------------------------------------------
        // 2. Preparamos la consulta para productos y categorías
        // ------------------------------------------------------
        $consulta = "SELECT p.id, p.nom, p.descripció, p.preu, c.nom as categoria
                     FROM productes p
                     INNER JOIN categories c ON p.categoria_id = c.id";

        // Ejecutamos la consulta y guardamos el resultado en $resultado
        $resultado = $conexion->query($consulta);

        // ------------------------------------------------------
        // 3. Comenzamos a generar la estructura HTML (cabecera)
        // ------------------------------------------------------
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

        // ------------------------------------------------------
        // 4. Verificamos si hay filas devueltas por la consulta
        // ------------------------------------------------------
        if ($resultado->num_rows > 0) {
            // Muestra un botón para crear un nuevo producto (Nou.php)
            echo '<hr><a href="Nou.php" class="btn btn-primary">Nou producte</a><hr>';

            // ------------------------------------------------------
            // 5. Si hay productos, mostramos una tabla con Bootstrap
            // ------------------------------------------------------
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

            // Variable para numerar cada producto en la primera columna
            $i = 1;

            // Recorremos el conjunto de resultados y mostramos cada producto
            while ($fila = $resultado->fetch_assoc()) {
                // Cada fila de la tabla contiene la información del producto
                // y los botones para modificar o eliminar
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

            // ------------------------------------------------------
            // 6. Incluye el footer de la página
            // ------------------------------------------------------
            require_once('Footer.php');
        } else {
            // Si no se encontraron productos, muestra un mensaje alternativo
            echo '<p>No hi ha productes.</p>';
        }

        // ------------------------------------------------------
        // 7. Cerrar la conexión con la base de datos
        // ------------------------------------------------------
        $conexion->close();
    }
}

// ------------------------------------------------------
// 8. Instanciamos la clase Principal y llamamos al método
//    para que se genere todo el contenido HTML
// ------------------------------------------------------
$listaProductos = new Principal();
$listaProductos->mostrarProductes();

?>
