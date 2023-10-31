<?php

$data = file_get_contents("php://input");
$valor = json_decode($data, true);


if ($valor == null) {
    echo "ERROR JSON VACIO";
} else {
?> <div class='contenedorTablas'>
        <h3>
            Gestion de datos de el almacen N°" <?php echo $valor["0"]; ?>
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
            <tbody>
                <?php
                foreach ($valor["1"] as $fila) {


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

                echo "</tbody></table>";

                echo '
        <input type="hidden" name="id_almacen" value="' . $valor["0"] . '">';
                ?>
                <input type="radio" id="cargar_paquete" name="opcion" value="paquete">
                <label for="cargar_paquete">Cargar paquete</label>


                <input type="radio" id="formar_lote" name="opcion" value="formar">
                <label for="formar_lote">Formar Lote</label>

                <?php
                echo '<select name="matricula">';
                foreach ($valor["2"] as $fila) {

                    if ($fila["rol"] == "2") {

                        echo "<option value='" . $fila["matricula"] . "'>"
                            . $fila["matricula"] .
                            "</option>";
                    }
                }
                echo '</select>';



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


                ?>

                <input class="btnAniadir" type="submit" value="Ejecutar acción">

                </form>
            <?php
        }
            ?>


    </div>