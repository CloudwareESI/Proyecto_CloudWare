<?php
$data = file_get_contents("php://input");
$valor = json_decode($data, true);


if ($valor == null) {
    echo "ERROR JSON VACIO";
} else {
    $x = 0;
?> <script src="Js/popUp.js"></script>
    <div class='contenedorTablas'>
        <h3>
            Paquetes para enviar a central.
        </h3>
        <?php
        foreach ($valor["0"] as $fila) { ?>
            <div class="contenedorModal" data-index="eliminarPqt<? echo $x; ?>">
                <div class="modal">

                    <?php
                    $variables = $valor["0"][$x];
                    echo '<h2>Eliminar el paquete N°' . $variables['id_paquete'] . ' ' .
                        $variables['nombre_paquete']
                        . '</h2>
                                    <p>¿Esta seguro que desea eliminar al paquete ' .
                        $variables['id_paquete'] . '?</p>';

                    echo '
                        <div class="contenedorBtn">
                        <button type="button" class="cerrar">Cancelar</button>

                        <form action="almacen/controlador_almacen/agregar_paquetes.php" method="post">
                            <input type="hidden" name="op" value="eliminar">
                            <input type="hidden" name="id_almacen" value="N/A">
                            <input type="hidden" name="id_paquete" value="' . $variables["id_paquete"] . '">
                            <input id="CONFIRMAR" type="submit" name="CONFIRMAR" class="CONFIRMAR" value="CONFIRMAR" />
                        </form>
                        </div>
                        ';

                    ?>


                </div>
            </div>
        <?php $x = $x + 1;
        }
        ?>
        <table>
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Peso</th>
                    <th>Dimensiones</th>
                    <th>Fragil?</th>
                    <th>Fecha_recivido</th>
                    <th>Destino</th>
                    <th>Seleccionar</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <?php $y = 0;
            foreach ($valor["0"] as $fila) {

                if (isset($fila['fecha_entrega']) and isset($fila['fecha_de_entrega'])) {
                } else {

                    echo '
                    <form action="almacen/controlador_almacen/cargar_carga.php" method="post">
                    
                    <tr>
                    <td>' . $fila['id_paquete'] . '</td>  
                    <td>' . $fila['nombre_paquete'] . '</td>
                    <td>' . $fila['peso'] . ' gramos</td>
                    <td>' . $fila['dimenciones'] . ' cm3</td>
                    <td>';
                    if ($fila['fragil'] == "1") {
                        echo "Si";
                    } else {
                        echo "No";
                    }

                    echo '</td>
                        <td>' . $fila['fecha_ingreso'] . "/" . $fila['fecha_recibido'] . '</td>
                        <td>' . $fila['destino_calle'] . " " . $fila['nombre_localidad'] . " " . $fila['nombre_departamento'] . '</td>
                        <td> <input type="checkbox" id="seleccionar" name="paquetes[]" value="'
                        . $fila['id_paquete'] .
                        '">
                        </td>

                        <td>
                        <div class="box">
                        <a href="almacen/vista_almacen/modificar_paquete.php?id_paquete=' .
                        $fila['id_paquete'] .
                        '&nombre_paquete=' . $fila['nombre_paquete'] .
                        '&peso=' . $fila['peso'] .
                        '&dimenciones=' . $fila['dimenciones'] .
                        '&fecha_recibido=' . $fila['fecha_recibido'] .
                        '&fecha_entrega=' . $fila['fecha_entrega'] .
                        '&fecha_ingreso=' . $fila['fecha_ingreso'] .
                        '&fecha_cargado=' . $fila['fecha_cargado'] .
                        '&id_lote=' . $fila['id_lote_portador'] .
                        '&fragil=' . $fila['fragil'] .
                        '&id_almacen=' . $fila['id_almacen'] .
                        '&id_cruce=' . $fila['id_localidad_destino'] .
                        '">
                        <img class="icnModificar" img id="imagenTabla"
                        src="http://localhost/Proyecto_Cloudware/imagenes/imagenEditar.png"></a></div></td>
                    
                    <td> '; ?>
                    <button type="button" class="abrir" data-index="eliminarPqt<? echo $y; ?>"><i class="fas fa-trash"></i></button>

            <?php echo '
                </td>
            </tr>
            
            ';
                    $y = $y + 1;
                }
            }

            echo "</tbody></table>";

            echo '
            <input type="hidden" id="opcion" name="opcion" value="formar">
            <br>
            <div class="btn">
        <input id="btn" class="btn" type="submit" value="Crear Lote">
        </div>
        </form>
        ';

            ?>
    </div>

    <div class='contenedorTablas'>
        <h3>
            Lotes para enviar a central.
        </h3>
        <?php $x = 0;
        var_dump($x);
        foreach ($valor["1"] as $fila) {

            if (isset($fila["fecha_de_entrega"])) {
            } else {
                if ($fila["id_almacen"] == "1") {
        ?>
                    <div class="contenedorModal" data-index="eliminarLot<? echo $x; ?>">
                        <div class="modal">

                            <?php

                            echo '<h2>Eliminar el lote N°' . $fila['id_lote']
                                . '</h2>
                                    <p>¿Esta seguro que desea eliminar al lote ' .
                                $fila['id_lote'] . '?</p>';

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
            }
        }
        $y = 0;
        ?>
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
                    if (isset($fila["fecha_de_entrega"])) {
                    } else {
                        if ($fila["id_almacen"] == "1") {



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

                <td> '; ?>
                            <button type="button" class="abrir" data-index="eliminarPqt<? echo $y; ?>"><i class="fas fa-trash"></i></button>

            <?php echo '
            </td>
                </tr>
            
                ';
                            $y = $y + 1;
                        }
                    }
                }
                echo "</tbody></table>";

                echo '<br>';
                echo '<select name="matricula">';
                foreach ($valor["2"] as $fila) {
                    if ($fila["rol"] == "1") {
                        echo "<option value='" . $fila["matricula"] . "'>"
                            . $fila["matricula"] .
                            "</option>";
                    }
                }

                echo '</select>
            <br>
            <input type="hidden" id="opcion" name="opcion" value="lote">
            <div class="btn">
            <input id="btn" class="btn" type="submit" value="Cargar en camion">
            </div>
            </form>';
            }
            ?>
    </div>