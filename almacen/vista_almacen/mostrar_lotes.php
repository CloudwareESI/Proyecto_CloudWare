<?php
$data = file_get_contents("php://input");
$valor = json_decode($data, true);

if ($valor == null) {
    echo "ERROR JSON VACIO";
} else {
?>

    <div class='contenedorTablas'>
        <h3>Lotes de el almacen N°" <?php echo $valor["0"]; ?>
        </h3>
        <table>
            <thead>
                <tr>
                    <th>N° lote</th>
                    <th>Fecha de creacion</th>
                    <th>Destino</th>
                    <th>Seleccionar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($valor["1"] as $fila) {

                echo '
            <form action="almacen/controlador_almacen/cargar_carga.php" method="post">
            <tr>
            <td>' . $fila['id_lote'] . '</td>  
            <td>' . $fila['fecha_creacion'] . '</td>';

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
            echo "</tbody></table>";

            if ($valor["0"] == "1") {


                echo '<select name="matricula">';
                foreach ($valor["2"] as $fila) {

                    if ($fila["rol"] == "1") {
                        echo "<option value='" . $fila["matricula"] . "'>"
                            . $fila["matricula"] .
                            "</option>";
                    }
                }


                echo '</select>
        <input type="hidden" name="opcion" value="lote">
    <input class="btnAniadir" type="submit" value="Cargar en camion">
    </form>
    
    ';
            }
        }
            ?>
    </div>
    <br><br>