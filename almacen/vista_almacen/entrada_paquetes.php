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


            <div class="contenedorModal" data-index="modificarPqt<? echo $x; ?>">
                <div class="modal">
                    <?php
                    $variables = $valor[$x]; ?>
                    <div class="formulario">
                        <form class="formBase" action="almacen/controlador_almacen/agregar_paquetes.php" method="post">
                            <h2>Modificacion de datos</h2>

                            <input type="hidden" name="op" value="modificar">
                            <input type="hidden" name="id_paquete" value="<?= $fila['id_paquete'] ?>">
                            <input type="hidden" name="fecha_recibido" value="<?= $fila['fecha_recibido'] ?>">
                            <input type="hidden" name="fecha_entrega" value="<?= $fila['fecha_entrega'] ?>">
                            <input type="hidden" name="id_lote" value="<?= $fila['id_lote_portador'] ?>">
                            <br>
                            <div class="formularioModificar">

                                <?= "<p>Nombre actual: " . $fila['nombre_paquete'] . "</p>" ?>

                                <label for="matricula">Nombre de paquete:</label>
                                <input type="text" name="nombre_paquete">
                            </div>
                            <br>
                            <div class="formularioModificar">
                                <?= "<p>dimenciones actuales: " . $fila['dimenciones'] . "</p>" ?>

                                <label for="dimenciones">Nuevas dimenciones:</label>
                                <input type="text" name="dimenciones">
                            </div>
                            <br>
                            <div class="formularioModificar">
                                <?= "<p>Peso actual: " . $fila['peso'] . "</p>" ?>

                                <label for="peso">Nuevo peso:</label>
                                <input type="text" name="peso">
                            </div>
                            <br>
                            <div class="formularioModificar">
                                <?= "<p>Fragil?: " . $fila['fragil'] . "</p>" ?>

                                <label for="peso">0 para no 1 para si:</label>
                                <input type="number" name="fragil">
                            </div>
                            <br>
                            <div class="formularioModificar">
                                <label for="Localidad destino">Localidad:</label>
                                <br>
                                <select name="localidad_destino">


                                    <?php
                                    foreach ($valor["4"] as $localidad) {
                                        echo "<option value='" . $localidad["id_localidad"] . "'>"
                                            . $localidad["nombre_localidad"] . " " . $localidad["nombre_departamento"] .
                                            "</option>";
                                    }
                                    ?>
                                </select>

                            </div>
                            <br>
                            <div class="contenedorBtn">
                                <button type="button" class="cerrar">Cancelar</button>
                                <input id="btn" type="submit" value="Actualizar">
                            </div>
                            <br>
                        </form>

                    </div>


                </div>
            </div>

            <div class="contenedorModal" data-index="eliminarPqt<? echo $x; ?>">
                <div class="modal">

                    <?php
                    $variables = $valor["0"][$x];
                    echo '<h2>Eliminar el paquete N°' . $variables['id_paquete'] . ' ' .
                        $variables['nombre_paquete']
                        . '</h2><br>
                                    <p>¿Esta seguro que desea eliminar al paquete ' .
                        $variables['id_paquete'] . '?</p><br>';

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
        <div class="tabla">
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
                        </td>'; ?>

                        <td>
                            <button type="button" class="abrir" data-index="modificarPqt<? echo $y; ?>">
                                <i class="fas fa-wrench"></i>
                            </button>
                        </td>

                        <td>
                            <button type="button" class="abrir" data-index="eliminarPqt<? echo $y; ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                        </tr>

                <?php
                        $y = $y + 1;
                    }
                }

                echo "</tbody></table></div>";

                echo '
            <input type="hidden" id="opcion" name="opcion" value="formar">
            <br>
            <div class="btn">
        <input id="btnTabla" class="btn" type="submit" value="Crear Lote">
        </div>
        </form>
        ';

                ?>

                <div class="contenedorModal" data-index="agregar">
                    <div class="modal">
                        <div class="contenedorFormulario">

                            <form action="almacen/controlador_almacen/agregar_paquetes.php" method="post">
                                <h2>Agregar datos</h2>
                                <div class="formulario formBase">
                                    <div class="formularioPopUp1">
                                        <input type="hidden" name="op" value="agregar">
                                        <input type="hidden" name="id_almacen" value="N/A">
                                        <input type="hidden" name="id_almacen" value=<?php $_GET = "id_almacen" ?>>

                                        <div class="formularioModificar">
                                            <label for="nombre_paquete">Nombre:</label>
                                            <input type="text" name="nombre_paquete">
                                        </div>
                                        <div class="formularioModificar">
                                            <label for="dimenciones">Dimenciones:</label>
                                            <input type="text" name="dimenciones">
                                        </div>
                                        <div class="formularioModificar">
                                            <label for="peso">Peso:</label>
                                            <input type="text" name="peso">
                                        </div>

                                        <div class="btnEntrada1">
                                            <button id="btn" type="button" class="cerrar">Cancelar</button>
                                        </div>
                                    </div>
                                    <div class="formularioPopUp2">
                                        <div class="formularioModificar">
                                            <?= "<p>Fragil?:</p>" ?>
                                            <label for="peso">0 para no 1 para si:</label>
                                            <input type="number" name="fragil">
                                        </div>
                                        <div class="formularioModificar">
                                            <label for="Calle destino">Calle_destino:</label>
                                            <input type="text" name="calle_destino">
                                        </div>
                                        <div class="formularioModificar">
                                            <label for="Localidad destino">Localidad:</label>
                                            <select name="localidad_destino">
                                                <?php
                                                foreach ($valor["4"] as $fila) {
                                                    echo "<option value='" . $fila["id_localidad"] . "'>"
                                                        . $fila["nombre_localidad"] . " " . $fila["nombre_departamento"] .
                                                        "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="contenedorBtn">

                                            <input id="btn" type="submit" value="Actualizar">
                                        </div>

                                    </div>
                                </div>


                            </form>
                        </div>





                    </div>
                </div>


                <div class="btn">
                    <button type="button" id="btnTabla" class="abrir" data-index="agregar">
                        Agregar Paquete
                </div>
        </div>

        <div class='contenedorTablas'>
            <h3>
                Lotes para enviar a central.
            </h3>
            <?php $x = 0;

            foreach ($valor["1"] as $fila) {

                if (isset($fila["fecha_de_entrega"])) {
                } else {
                    if ($fila["id_almacen"] == "1") {
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
                }
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

                <td> ';
                        ?>
                                    <button type="button" class="abrir" data-index="eliminarPqt<? echo $y; ?>"><i class="fas fa-trash"></i></button>

                    <?php echo '
                </td>
                </tr>
            
                ';
                                    $y = $y + 1;
                                }
                            }
                        }
                        echo "</tbody></table></div>";

                        echo '<br>';
                        echo '<select name="matricula">';
                        foreach ($valor["2"] as $fila) {
                            if ($fila["rol"] == "1") {
                                echo "<option value='" . $fila["matricula"] . "'>"
                                    . $fila["matricula"] . " carga maxima" . $fila["peso_maximo"] .
                                    "</option>";
                            }
                        }

                        echo '</select>
            <br>
            <input type="hidden" id="opcion" name="opcion" value="lote">
          
            <input id="btnSelectBoton" class="btn" type="submit" value="Cargar en camion">
         
            </form>';
                    }
                    ?>
            </div>