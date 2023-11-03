<?php

$data = file_get_contents("php://input");
$valor = json_decode($data, true);
$x = 0;
var_dump($valor);
if ($valor == null) {
    echo "ERROR JSON VACIO";
} else {
    echo "<script src='Js/popUp.js'></script>
    <div class='contenedorTablas'>";
    echo "<h3>Backoffice de vehiculos</h3><table><tr>
        <table>
    <thead>
    <tr>
    <th>Matricula</th> <th>Modelo</th> 
    <th>Estado</th> <th>Rol</th> 
    <th>Modificar</th> 
    <th>Eliminar</th> 
    <th>Seleccionar</th> </tr>
    </thead><tbody>";
    foreach ($valor as $fila) {
        echo '<tr>
    <td>' . $fila['matricula'] . '</td>  
    <td>' . $fila['modelo'] . '</td>
    <td>';
        switch ($fila['estado']) {
            case '1':
                echo "Detenido";
                break;
            case '0':
                echo "En marcha";
                break;
            case '2':
                echo "Dañado";
                break;
            default:
                echo "N/A";
                break;
        }

        echo '</td>
    <td>';
        switch ($fila['rol']) {
            case '1':
                echo "Camion";
                break;
            case '2':
                echo "Camioneta";
                break;
            default:
                echo "N/A";
                break;
        }
?>
        </td>
        <td>
            <button class="abrir" data-index="modificar<? echo $x; ?>"><i class="fas fa-wrench"></i></button>

            <div class="contenedorModal" data-index="modificar<? echo $x; ?>">
                <div class="modal">
                    <?php
                    $variables = $valor[$x]; ?>
                    <div class="contenedorFormulario">
                        <form action="vehiculos/controlador_vehiculos/agregar_vehiculos.php" method="post">

                            <div class="formulario">
                                <h2>Modificacion de datos</h2>

                                <input type="hidden" name="op" value="modificar">
                                <input type="hidden" name="matricula_vieja" value="<?= $variables['matricula'] ?>">
                                <div class="formularioModificar">
                                    <?= "<p>Matricula actual: " . $variables['matricula'] . "</p>" ?>
                                    <label for="matricula">Nueva matricula:</label>
                                    <input type="text" name="matricula"><br>
                                </div>
                                <div class="formularioModificar">
                                    <?php echo "<p>Estado actual: ";
                                    switch ($variables['estado']) {
                                        case '1':
                                            echo "Detenido";
                                            break;
                                        case '0':
                                            echo "En marcha";
                                            break;
                                        case '2':
                                            echo "Dañado";
                                            break;
                                    }
                                    echo "</p>"; ?>


                                    <label for="estado">Nuevo estado:</label>
                                    <select id="selectCamion" name="estado">
                                        <option value="0">
                                            Detenido
                                        </option>
                                        <option value="1">
                                            En marcha
                                        </option>
                                        <option value="2">
                                            Dañado
                                        </option>
                                    </select>
                                </div>

                                <div class="formularioModificar">
                                    <?= "<p>Modelo actual: " .
                                        $variables['modelo'] .
                                        "</p>" ?>

                                    <label for="modelo">Nuevo modelo:</label>

                                    <input type="text" name="modelo"><br><br>


                                    <?php echo "<p>Rol actual: ";
                                    switch ($variables['rol']) {
                                        case '1':
                                            echo "Camion";
                                            break;
                                        case '2':
                                            echo "Camioneta";
                                            break;
                                        default:
                                            echo "N/A";
                                            break;
                                    }

                                    echo "</p>" ?>
                                </div>
                                <div class="formularioModificar">
                                    <label for="rol">Nuevo Rol:</label>
                                    <select name="rol">
                                        <option value="1">
                                            Camion
                                        </option>
                                        <option value="2">
                                            Camioneta
                                        </option>
                                    </select>
                                </div>
                                <div class="btn">
                                    <input id="btn" type="submit" value="Actualizar">
                                </div>
                            </div>
                        </form>
                    </div>
                    <button class="cerrar">Cancelar</button>

                </div>
            </div>


        <td>

            <button type="button" class="abrir" data-index="eliminar<? echo $x; ?>"><i class="fas fa-trash"></i></button>
            <div class="contenedorModal" data-index="eliminar<? echo $x; ?>">
                <div class="modal">
                    <?php
                    $variables = $valor[$x];
                    echo '<h2>Eliminar camion ' . $variables['matricula'] . '</h2>
                <p>¿Esta seguro que desea eliminar al camion ' .
                        $variables['matricula'] . '?</p>';

                    echo '
                <div class="contenedorBtn">
                <button class="cerrar">Cancelar</button>

                <form action="vehiculos/controlador_vehiculos/agregar_vehiculos.php" method="post">
                    <input type="hidden" name="op" value="eliminar">
                    <input type="hidden" name="matricula" value="' . $variables["matricula"] . '">
                    <input id="CONFIRMAR" type="submit" name="CONFIRMAR" class="CONFIRMAR" value="CONFIRMAR" />
                </form>

            </div>
                ';

                    ?>


                </div>
            </div>

    <?php echo '</td>
        <td>
        <div class="box">
        <a href="http://localhost/Proyecto_Cloudware/vehiculos/views_vehiculos/vehiculo.php?matricula='
            . $fila['matricula'] . '&rol='
            . $fila['rol'] . '&estado='
            . $fila['estado'] . '
        ">
        <img class="icnEliminar" img id="imagenTabla" src="http://localhost/Proyecto_Cloudware/imagenes/imagenBorrar.png"></a>
        </div>
        </td>
        </tr>';
        $x = $x + 1;
    }
    echo "</tbody></table>";
}
    ?>
    <br>


    <div class="contenedorModal" data-index="agregar">
        <div class="modal">
            <div class="contenedorFormulario">

                <div class="formulario">
                    <form action="vehiculos/controlador_vehiculos/agregar_vehiculos.php" method="post">
                        <h2>Agregar datos</h2>
                        <br>
                        <br>
                        <input type="hidden" name="op" value="agregar">

                        <div class="formularioModificar">
                            <input type="text" name="matricula">
                            <label for="matricula">Matricula:</label>
                        </div>
                        <div class="formularioModificar">
                            <label for="estado">Estado:</label>

                            <select name="estado">
                                <option value="0">
                                    Detenido
                                </option>
                                <option value="1">
                                    En marcha
                                </option>
                                <option value="2">
                                    Dañado
                                </option>
                            </select>
                        </div>
                        <br>
                        <div class="formularioModificar">
                            <input type="text" name="modelo">
                            <label for="modelo">Modelo:</label>
                        </div>

                        <div class="formularioModificar">
                            <label for="rol">Rol:</label>

                            <select name="rol">
                                <option value="1">
                                    Camion
                                </option>
                                <option value="2">
                                    Camioneta
                                </option>
                            </select>
                        </div>

                        <div class="btn">
                            <input id="btn" type="submit" value="Actualizar">
                        </div>
                </div>
            </div>

            <div class="contenedorBtn">
                <button class="cerrar">Cancelar</button>

            </div>



        </div>
    </div>


    <div class="btn">
        <button type="button" class="abrir" data-index="eliminar<? echo $x; ?>">
            Agregar
        </button>
    </div>
    </div>