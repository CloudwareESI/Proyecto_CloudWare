<?php
var_dump($_SESSION);

$data = file_get_contents("php://input");
$valor = json_decode($data, true);
$rol = $valor["3"]; 

if ($valor == null) {
    echo "ERROR JSON VACIO";
} else {
?> <div class='contenedor'>
        <h3>
            Paquetes para enviar a central.
        </h3>
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
            <?php
            foreach ($valor["0"] as $fila) {

                if (isset($fila['fecha_entrega'])) {
                } else {
                    if (isset($fila["id_almacen"])) {
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
            }else{
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
            
                    <td><div class="box"><a href="almacen/vista_almacen/eliminar_conf_paquete.php?id_paquete=' .
                            $fila['id_paquete'] .
                            '&nombre_paquete=' . $fila['nombre_paquete'] .
                            '&peso=' . $fila['peso'] .
                            '">
                <img class="icnEliminar" img id="imagenTabla" 
                src="http://localhost/Proyecto_Cloudware/imagenes/imagenBorrar.png"></a>
            
            </div></td>
            </tr>
            
            ';
                    }
                }
            }

            echo "</tbody></table>";
            if ($rol == "1" or $rol == "0"){
            echo '
        <input type="hidden" name="id_almacen" value="' . NULL . '">
        <input type="hidden" name="opcion" value="formar">
        <input class="btnAniadir" type="submit" value="Crear Lote">
</form>

'; }

            ?>
        <div class='contenedor'>
            <button class="btnAniadir" onclick="window.location.href='almacen/vista_almacen/agregar_paquete.php';">
                Agregar Paquete
            </button>
        </div>
    </div>

    <div class='contenedor'>
        <h3>
            Lotes para enviar a central.
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

            if (isset($fila["id_almacen"])) {
            } else {


                echo '
                <form action="almacen/controlador_almacen/cargar_carga.php" method="post">
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
        echo "</tbody></table>";

        if ($rol == "1" or $rol == "0"){
        echo '<select name="matricula">';
        foreach ($valor["2"] as $fila) {
            if($fila["rol"] == "1"){
                echo "<option value='" . $fila["matricula"] . "'>"
                . $fila["matricula"] .
                "</option>";
            }
        }
        

        
        echo '</select>
    <input class="btnAniadir" type="submit" value="Cargar en camion">
    </form>
    ';
    }}
        ?>
    </div>