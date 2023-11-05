<?php

$data = file_get_contents("php://input");
$valor = json_decode($data, true);
$y = 0;

if ($valor == null) {
    echo "ERROR JSON VACIO";
} else {
    echo "<div class='contenedorTablas'><h3>Backoffice de Rutas</h3>
    ";
    foreach ($valor as $subvalor) {


        echo "
        <div class='tabla'>
        <table>
        <thead>
        <tr>
        <th id='thRuta'>Ruta N°" . $subvalor[0]['id_ruta'] . "</th> "; ?>
        <th id='thRuta'>

            <button type="button" class="abrir" data-index="eliminarRuta<? echo $y; ?>">
                <i class="fas fa-trash"></i>
            </button>

            <div class="contenedorModal" data-index="eliminarRuta<? echo $y; ?>">
                <div class="modal">
                    <?php

                    echo '<h2>Eliminar ruta ' . $subvalor[0]['id_ruta']  . '</h2>
                    <p>¿Esta seguro que desea eliminar a la ruta ' .
                    $subvalor[0]['id_ruta']  . '?</p>';

                    echo '
                    <div class="contenedorBtn">
                    <button class="cerrar">Cancelar</button>

                    <form action="vehiculos/controlador_vehiculos/agregar_vehiculos.php" method="post">
                        <input type="hidden" name="op" value="eliminar_ruta">
                        <input type="hidden" name="id_ruta" value="' . $subvalor[0]['id_ruta']  . '">
                        <input id="CONFIRMAR" type="submit" name="CONFIRMAR" class="CONFIRMAR" value="CONFIRMAR" />
                    </form>

                </div>
                ';
                    ?>


                </div>
            </div>

        </th>
        <?php
        echo "
        </tr>
        <tr>
        <th>Id_almacen</th> 
        <th>Chapa</th> 
        <th>Calle</th> 
        <th>Localidad</th> 
        <th>Departamento</th> 
        <th>Modificar</th> 
        <th>Eliminar</th> 
        </tr>
        </thead><tbody>";
        $numUbicacion = 0;
        foreach ($subvalor as $fila) {

            echo '<tr>
            <td>' . $fila['id_almacen'] . '</td>  
            <td>' . $fila['chapa'] . '</td>
            <td>' . $fila['calle'] . '</td>
            <td>' . $fila['nombre_localidad'] . '</td>
            <td>' . $fila['nombre_departamento'] . '</td>

            <td><div class="box"><a href="vehiculos/views_vehiculos/modificar_ruta.php?id=' .
                $fila['id_ruta'] .
                '"><img class="icnModificar" img id="imagenTabla" 
                src="http://localhost/Proyecto_Cloudware/imagenes/imagenEditar.png"></a></div></td>'; ?>

            <td>

                <button type="button" class="abrir" data-index="eliminar<? echo $numUbicacion; ?>">
                    <i class="fas fa-trash"></i>
                </button>

                <div class="contenedorModal" data-index="eliminar<? echo $numUbicacion; ?>">
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
                        <input type="hidden" name="op" value="eliminar_ubicacion">
                        <input type="hidden" name="id_ruta" value="' . $variables["id_ubicacion"] . '">
                        <input type="hidden" name="id_almacen" value="' . $variables["id_ubicacion"] . '">
                        <input id="CONFIRMAR" type="submit" name="CONFIRMAR" class="CONFIRMAR" value="CONFIRMAR" />
                    </form>

                </div>
                ';
                        ?>


                    </div>
                </div>
            </td>
            </tr>

<?php
            $numUbicacion = $numUbicacion + 1;
        }
        $y = $y + 1;

        echo "</tbody></table></div>";
    }
}
?>


<form action="vehiculos/views_vehiculos/agregar_ruta.php" method="POST">
    <input class="btnAniadir" type="submit" value="Agregar una ruta">
    <input type="number" name="ubicaciones">
</form>

</div>