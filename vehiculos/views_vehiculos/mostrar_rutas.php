<?php

$data = file_get_contents("php://input");
$valor = json_decode($data, true);

if ($valor == null) {
    echo "ERROR JSON VACIO";
} else {
    echo "<div class='contenedorTablas'><h3>Backoffice de Rutas</h3>        
    <script src='Js/popUp.js'></script>
    ";

    foreach ($valor as $key => $subvalor) {
        foreach ($subvalor as $numUbicacion => $fila) {
?>
            <div class="contenedorModal" data-index="eliminarUbicacion<? echo $fila['posicion'] . $fila['id_almacen'] . $fila['id_ruta']; ?>">
                <div class="modal">
                    <?php

                    echo '<h2>Eliminar ubicacion numero ' . $fila['posicion'] . ' de la ruta ' . $fila['id_ruta'] . '</h2><br>
                            <p>¿Esta seguro que desea eliminar a la ubicacion ' .
                        $fila['posicion'] . '?</p><br>';

                    echo '
                            <div class="contenedorBtn">
                            <button id="btn "class="cerrar">Cancelar</button>
        
                            <form action="vehiculos/controlador_vehiculos/gestion_ruta.php" method="post">
                                <input type="hidden" name="op" value="eliminar_ubicacion">
                                <input type="hidden" name="id_ruta" value="' . $fila["id_ruta"] . '">
                                <input type="hidden" name="id_almacen" value="' . $fila["id_almacen"] . '">
                                <input id="CONFIRMAR" type="submit" name="CONFIRMAR" class="CONFIRMAR" value="CONFIRMAR" />
                            </form>
        
                            </div>
                            ';
                    ?>


                </div>
            </div>
        <?php
        }
    }

    foreach ($valor as $key => $subvalor) {
        # code...


        echo "
        <br>
        <br>
        <div class='tabla'>
        <table>
        <thead>
        <tr>
        <th id='thRuta'>Ruta N°" .  $subvalor[0]['id_ruta'] . "</th> "; ?>

        </th>
        <br>
        <?php
        echo "
        </tr>
        <tr>
        <th>N°</th> 
        <th>Id_almacen</th> 
        <th>Chapa</th> 
        <th>Calle</th> 
        <th>Localidad</th> 
        <th>Departamento</th>
        <th>Eliminar</th> 
        </tr>
        </thead><tbody>";


        foreach ($subvalor as $numUbicacion => $fila) {

            echo '<tr>
            <td>' . $fila['posicion'] . '</td> 
            <td>' . $fila['id_almacen'] . '</td>  
            <td>' . $fila['chapa'] . '</td>
            <td>' . $fila['calle'] . '</td>
            <td>' . $fila['nombre_localidad'] . '</td>
            <td>' . $fila['nombre_departamento'] . '</td>';
        ?>

            <td><button type="button" class="abrir" data-index="eliminarUbicacion<?php echo $fila['posicion'] . $fila['id_almacen'] . $fila['id_ruta']; ?>">
                    <i class="fas fa-trash"></i>
                </button>

            </td>
            </tr>

<?php
        }



        echo "</tbody></table></div>
        <br></div>";
    }
}
?>

<div class="selectBoton">
    <br>
    <form action="vehiculos/views_vehiculos/agregar_ruta.php" method="POST">

        <label id="btnSelectLabel" for="ubicaciones">Numero de trechos</label>
        <input id="btnSelectBoton5" type="number" min="0" name="ubicaciones">

        <input id="btnSelectBoton4" type="submit" value="Agregar una ruta">



    </form>
</div>


<div class='contenedorTablas'>
    <h3>Eliminar Rutas</h3>
    <div class='tabla'>
        <table>
            <thead>

                <tr>
                    <th>N°Ruta</th>
                    <th>N°de ubicaciones visitadas</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($valor as $key => $subvalor) {
                ?>

                    <tr>
                        <td>
                            <?= $subvalor[0]['id_ruta'] ?>
                        </td>
                        <td>
                            <?php
                            $Ubicaciones = 0;
                            foreach ($subvalor as $llave => $valor) {
                                $Ubicaciones = $Ubicaciones + 1;
                            }
                            echo $Ubicaciones;
                            ?>
                        </td>
                        <td>

                            <div class="contenedorModal" data-index="eliminarRuta<?php echo $key; ?><?php echo $subvalor[0]['id_ruta']; ?>">
                                <div class="modal">
                                    <?php
                                    echo '<h2>Eliminar ruta ' . $subvalor[0]['id_ruta']  . '</h2><br>
                                <p>¿Esta seguro que desea eliminar a la ruta ' .
                                        $subvalor[0]['id_ruta']  . '?</p><br> ';
                                    echo '
                                <div class="contenedorBtn"> 
                                <button id="btn" class="cerrar">Cancelar</button>
                                <form action="vehiculos/controlador_vehiculos/gestion_ruta.php" method="post">
                                    <input type="hidden" name="op" value="eliminar_ruta">
                                    <input type="hidden" name="id_ruta" value="' . $subvalor[0]['id_ruta']  . '">
                                    <input id="CONFIRMAR" type="submit" name="CONFIRMAR" class="CONFIRMAR" value="CONFIRMAR" />
                                </form>
                                </div>
                                ';
                                    ?>
                                </div>
                            </div>
                            <button type="button" class="abrir" data-index="eliminarRuta<?php echo $key . $subvalor[0]['id_ruta']; ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<br>