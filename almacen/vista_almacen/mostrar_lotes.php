<?php
require "../../db/db_conn.php";

$base_datos = new base_de_datos();

$query = "SELECT * FROM vehiculo v WHERE rol='1'";
$resultado = $base_datos->conexion()->execute_query($query);
$matriz = $resultado->fetch_all(MYSQLI_ASSOC);


$data = file_get_contents("php://input");
$valor = json_decode($data, true);
var_dump($matriz);

if ($valor == null) {
    echo "ERROR JSON VACIO";
} else {
?>

    <div class='contenedor'>
        <h3>Lotes de el almacen N°" <?php echo $valor["0"]; ?>
        </h3>
        <table>
            <tr>
                <td>N° lote</td>
                <td>Fecha de creacion</td>
                <td>Destino</td>
                <td>Seleccionar</td>
                <td>Eliminar</td>
            </tr>
        <?php
        foreach ($valor["1"] as $fila) {

            if ($valor["0"]  == $fila["id_almacen"]) {


                echo '
            <form action="almacen/controlador_almacen/cargar_lotes.php" method="post">
            <tr>
            <td>' . $fila['id_lote'] . '</td>  
            <td>' . $fila['fecha_creacion'] . '</td>';

                /*<td>' . $fila['id_almacen'] . '</td>
            <td>' . $fila['matricula_camion'] . '</td>
            <td>' . $fila['id_destino'] . '</td>
            <td>' . $fila['fecha_recibido'] . '</td>*/

                echo '
            <td>' . $fila['nombre_localidad'] . " " . $fila['nombre_departamento'] . '</td>
            <td> <input type="checkbox" id="seleccionar" name="lotes[]" value="'
                    . $fila['id_lote'] .
                    '">
            </td>

            <td>
            <div class="box"><a href="almacen/vista_almacen/eliminar_confirmacion_lotes.php?id_lote=' .
                    $fila['id_lote'] .
                    '">
                <img class="icnEliminar" img id="imagenTabla" 
                src="http://localhost/Proyecto_Cloudware/imagenes/imagenBorrar.png"></a>
            
            </div></td>
            </tr>
            
            ';
            }
        }
        echo "</table>";


        echo '<select name="matricula">';
        foreach ($matriz as $fila) {
            echo "<option value='" . $fila["matricula"] . "'>"
                . $fila["matricula"] .
                "</option>";
        }

        echo '</select>
    <input class="btnAniadir" type="submit" value="Cargar en camion">
    </form>
    ';
    }
        ?>
    </div>