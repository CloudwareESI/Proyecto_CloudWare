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


        <?php $x = 0;
        var_dump($x);
        foreach ($valor["1"] as $fila) {


        ?>
            <div class="contenedorModal" data-index="eliminarLot<? echo $x; ?>">
                <div class="modal">

                    <?php

                    echo '<h2>Eliminar el lote N°' . $fila['id_lote']
                        . '</h2><br>
                                    <p>¿Esta seguro que desea eliminar al lote ' .
                        $fila['id_lote'] . '?</p><br>';

                    echo '
                        <div class="contenedorBtn">
                        <button type="button" class="cerrar">Cancelar</button>

                        <form action="almacen/controlador_almacen/agregar_paquetes.php" method="post">
                            <input type="hidden" name="op" value="eliminarLote">
                            <input type="hidden" name="id_almacen" value="N/A">
                            <input type="hidden" name="id_lote" value="' . $fila["id_lote"] . '">
                            <input id="CONFIRMAR" type="submit" name="CONFIRMAR" class="CONFIRMAR" value="CONFIRMAR" />
                        </form>
                        </div>
                        ';

                    ?>


                </div>
            </div>
        <?php $x = $x + 1;
        }
        $y = 0;
        ?>

<div class="tabla">
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

            <td>'; ?>
                    <button type="button" class="abrir" data-index="eliminarLot<? echo $y; ?>"><i class="fas fa-trash"></i></button>

            <?php echo '</td>
            </tr>
            
            ';
                    $y = $y + 1;
                }
                echo "</tbody></table></div>";

                if ($valor["0"] == "1") {

                    echo '<br>';
                    echo ' <div class="selectBoton">
                    <select name="matricula">';
                    foreach ($valor["2"] as $fila) {

                        if ($fila["rol"] == "1") {
                            echo "<option value='" . $fila["matricula"] . "'>"
                                . $fila["matricula"] .
                                "</option>";
                        }
                    }


                    echo '</select>
        <input type="hidden" name="opcion" value="lote">
        <br>
       
    <input id="btnSelectBoton3" type="submit" value="Cargar">
    </div>
    </form>
    
    ';
                }
            }
            ?>
    </div>
    <br><br>