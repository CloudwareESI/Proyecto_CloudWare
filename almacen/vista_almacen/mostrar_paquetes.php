<?php

$data = file_get_contents("php://input");
$valor = json_decode($data, true);


if ($valor == null) {
    echo "ERROR JSON VACIO";
} else {
    $x = 0;
?> <div class='contenedorTablas'>
        <script src='Js/popUp.js'></script>
        <h3>
            Gestion de datos de el almacen N° <?php echo $valor["0"]; ?>
        </h3>
        <?php
        foreach ($valor["1"] as $fila) { ?>

            <div class="contenedorModal" data-index="modificar">
                <div class="modal">
                    <div class="contenedorFormulario">

                        <form action="almacen/controlador_almacen/agregar_paquetes.php" method="post">
                            <?php
                            $variables = $valor[$x]; ?>
                            <form class="formBase" action="almacen/controlador_almacen/agregar_paquetes.php" method="post">
                                <h2>Modificacion de datos</h2>
                                <div class="formulario formBase">
                                    <div class="formularioPopUp1">
                                        <input type="hidden" name="id_almacen" value="<?= $valor["0"] ?>">
                                        <input type="hidden" name="op" value="modificar">
                                        <input type="hidden" name="id_paquete" value="<?= $fila['id_paquete'] ?>">
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
                                        <div class="btnEntrada1">
                                            <button id="btn" type="button" class="cerrar">Cancelar</button>
                                        </div>
                                    </div>
                                    <div class="formularioPopUp2">
                                        <br>
                                        <div class="formularioModificar">
                                            <?= "<p>Fragil?: " . $fila['fragil'] . "</p>" ?>

                                            <label for="peso">0 para no 1 para si:</label>
                                            <input type="number" name="fragil">
                                        </div>
                                        <br>
                                        <div class="formularioModificar">
                                            <?= "<p>Destino actual: " . $fila['destino_calle'] . "</p>" ?>
                                            <label for="Calle destino">Calle_destino:</label>
                                            <input type="text" name="calle_destino">
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

                                            <input id="btn" type="submit" value="Actualizar">
                                        </div>

                                    </div>
                                </div>


                            </form>
                    </div>





                </div>
            </div>

            <div class="contenedorModal" data-index="eliminarPqt<? echo $x; ?>">
                <div class="modal">

                    <?php
                    $variables = $fila;
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
                                        <input type="hidden" name="id_almacen" value="' . $valor["0"] . '">
                                        <input type="hidden" name="id_paquete" value="' . $variables["id_paquete"] . '">
                                        <input id="CONFIRMAR" type="submit" name="CONFIRMAR" class="CONFIRMAR" value="CONFIRMAR" />
                                    </form>
                                    </div>
                                    ';

                    ?>


                </div>
            </div>
        <?php }
        ?>
        <div class="tabla">
            <table>
                <form action="almacen/controlador_almacen/cargar_carga.php" method="post">

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
                    <tbody>
                        <?php
                        foreach ($valor["1"] as $fila) {


                            echo '
            
            
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
                                <button type="button" class="abrir" data-index="modificarPqt<? echo $x; ?>">
                                    <i class="fas fa-wrench"></i>
                                </button>
                            </td>

                            <td>
                                <button type="button" class="abrir" data-index="eliminarPqt<? echo $x; ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                            </tr>

                        <?php
                            $x = $x + 1;
                        }

                        echo "</tbody></table>
                            </div></div>";

                        echo '
                            <input type="hidden" name="id_almacen" value="' . $valor["0"] . '">';
                        ?>
                        <div class="tablasPaqueteLote">
                            <label for="cargar_paquete">Cargar paquete</label>
                            <input type="radio" id="cargar_paquete" name="opcion" value="paquete">




                            <label for="formar_lote">Formar Lote</label>
                            <input type="radio" id="formar_lote" name="opcion" value="formar">

                        </div>

                        <?php

                        echo '<br>   ';

                        echo '<div class="selectBoton">
                        <select name="matricula">';
                        foreach ($valor["2"] as $fila) {

                            if ($fila["rol"] == "2") {

                                echo "<option value='" . $fila["matricula"] . "'>"
                                    . $fila["matricula"] .
                                    "</option>";
                            }
                        }
                        echo '</select>';

                        echo '<br>';

                        echo '<select name="destino">';
                        foreach ($valor["3"] as $ruta) {

                            foreach ($ruta as $fila) {
                                echo "<option value='" . $fila["id_ruta"] . "|" . $fila["id_almacen"] . "'>
                            Almacen " . $fila["nombre_localidad"] . "," .
                                    $fila["nombre_departamento"] . " por ruta N°" .
                                    $fila["id_ruta"] .
                                    "</option>";
                            }
                        }
                        echo '</select>';

                        echo '<br>   ';

                        ?>

                        <input type="hidden" name="id_almacen" value="<?php echo $valor["0"]; ?>">
                        <input id="btnSelectBoton3" type="submit" value="Ejecutar">

        </div>
        </form>
    <?php
}
    ?>