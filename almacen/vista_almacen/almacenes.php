<script src="Js/popUp.js"></script>
<?php

$data = file_get_contents("php://input");



$valor = json_decode($data, true);


$almacenes = $valor[0];

if ($almacenes == null) {
    echo "ERROR JSON VACIO";
} else {
    echo "<div class='contenedorTablas'>";
    echo "<h3>Almacenes</h3>
    <div class='tabla'>
    <table>
    <thead>
    <tr>
    <td>Numero</td> 
    
    <th>Calle</th> 
    <th>Chapa</th> 
    <th>Localidad</th> 
    <th>Departamento</th> 
    <th>Seleccionar</th>";
    if ($valor[1] == 0) {
        echo " <th>Eliminar</th>";
    }


    echo "
    </tr></thead><tbody>";
    foreach ($almacenes as $key => $fila) {
        echo '<tr>
        <td>' . $fila['id_almacen'] . '</td>  
        <td>' . $fila['calle'] . '</td> 
        <td>' . $fila['chapa'] . '</td> 
        <td>' . $fila['nombre_localidad'] . '</td> 
        <td>' . $fila['nombre_departamento'] . '</td>

        <td><div class="box"><a href="http://' . $_SERVER["HTTP_HOST"] . '/Proyecto_Cloudware/index.php?id_almacen=' . $fila['id_almacen'] . '
            &Almacenes=1
        ">
        
        <button>  <i class="fa-solid fa-check"></i></button></a>
        </div></td>';

        if ($valor[1] == 0) {
?>
            <div class="contenedorModal" data-index="eliminarAlm<? echo $key; ?>">
                <div class="modal">

                    <?php
                    $variables = $fila;
                    echo '<h2>Eliminar el almacen N°' . $variables['id_almacen']
                        . '</h2><br>
                                    <p>¿Esta seguro que desea eliminar al Almacen ' .
                        $variables['id_almacen'] . '?</p><br>';

                    echo '
                        <div class="contenedorBtn">
                        <button type="button" class="cerrar">Cancelar</button>

                        <form action="almacen/controlador_almacen/gestion_almacenes.php" method="post">
                            <input type="hidden" name="op" value="eliminar">
                            <input type="hidden" name="id_almacen" value="' . $variables["id_almacen"] . '">
                            <input id="CONFIRMAR" type="submit" name="CONFIRMAR" class="CONFIRMAR" value="CONFIRMAR" />
                        </form>
                        </div>
                        ';

                    ?>


                </div>
            </div>

            <td>
                <button type="button" class="abrir" data-index="eliminarAlm<? echo $key; ?>">
                    <i class="fas fa-wrench"></i>
                </button>
            </td>

<?php
        }
        echo '</tr>';
    }
    echo "</tbody></table></div>";
}
?>

</div>


<div class="contenedorModal" data-index="agregar_alm">
    <div class="modal">
        <div class="contenedorFormulario">

            <form action="almacen/controlador_almacen/gestion_almacenes.php" method="post">
                <h2>Agregar datos</h2>
                <div class="formulario formBase">
                    <div class="formularioPopUp1">
                        <input type="hidden" name="op" value="agregar">


                        <div class="formularioModificar">
                            <label for="calle_destino">Calle:</label>
                            <input type="text" name="calle_destino">
                        </div>
                        <div class="formularioModificar">
                            <label for="chapa">Chapa:</label>
                            <input type="text" name="chapa">
                        </div>
                        <div class="formularioModificar">
                            <label for="localidad_destino">Localidad:</label>
                            <select name="localidad_destino">
                                <?php
                                foreach ($valor[2] as $fila) {
                                    echo "<option value='" . $fila["id_localidad"] . "'>"
                                        . $fila["nombre_localidad"] . " " . $fila["nombre_departamento"] .
                                        "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="contenedorBtn">
                            <button type="button" class="cerrar">Cancelar</button>
                            <input id="btn" type="submit" value="Actualizar">
                        </div>

                    </div>
                </div>


            </form>
        </div>





    </div>
</div>

<?php 
if ($valor[1] == 0) {
    ?>
<div class="btn">
    <button type="button" id="btnTabla" class="abrir" data-index="agregar_alm">
        Agregar Almacen
</div>
<?php
}
?>