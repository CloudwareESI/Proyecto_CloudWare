<?php

$data = file_get_contents("php://input");
$valor = json_decode($data, true);


if ($valor == null) {
    echo "ERROR JSON VACIO";
} else {
?> <div class='contenedor'>
        <h3>
            Gestion de datos de el almacen N°" <?php echo $valor["0"]; ?>
        </h3>
        <table>
            <tr>
                <td>Codigo</td>
                <td>Nombre</td>
                <td>Peso</td>
                <td>Dimensiones</td>
                <td>Fragil?</td>
                <td>Fecha_recivido</td>
                <td>Destino</td>
                <td>Seleccionar</td>
                <td>Modificar</td>
                <td>Eliminar</td>
            </tr>
        <?php
        foreach ($valor["1"] as $fila) {

            if (isset($fila['fecha_entrega'])) {
            } else {
                if ($valor["0"]  == $fila["id_almacen"]) {
                    echo '
            <form action="almacen/controlador_almacen/formar_lote.php" method="post">
            <tr>
            <td>' . $fila['id_paquete'] . '</td>  
            <td>' . $fila['nombre_paquete'] . '</td>
            <td>' . $fila['peso'] . '</td>
            <td>' . $fila['dimenciones'] . '</td>
            <td>' . $fila['fragil'] . '</td>
            
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

        echo "</table>";

        echo '
        <input type="hidden" name="id_almacen" value="' . $valor["0"] . '">
        <input class="btnAniadir" type="submit" value="Crear Lote">
</form>
';
    }
        ?>


    </div>