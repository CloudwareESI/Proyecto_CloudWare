<?php

$data = file_get_contents("php://input");
$valor = json_decode($data, true);


if ($valor == null) {
    echo "ERROR JSON VACIO";
} else {
    echo "<div class='contenedor'>";
    echo "<h3>Backoffice de vehiculos</h3><table><tr>
        <table>
    <thead>
    <tr>
    <th>Matricula</th> <th>Modelo</th> 
    <th>Estado</th> <th>Rol</th> 
    <th>Modificar</th> <th>Eliminar</th> 
    <th>Seleccionar</th> </tr>
    </thead><tbody>";
    foreach ($valor as $fila) {
        echo '<tr>
    <td>' . $fila['matricula'] . '</td>  
    <td>' . $fila['modelo'] . '</td>
    <td>' . $fila['estado'] . '</td>
    <td>' . $fila['rol'] . '</td>
    <td><div class="box"><a href="vehiculos/views_vehiculos/modificar_vehiculos.php?matricula=' .
            $fila['matricula'] .
            '&modelo=' . $fila['modelo'] .
            '&estado=' . $fila['estado'] .
            '&rol=' . $fila['rol'] .
            '"><img class="icnModificar" img id="imagenTabla" src="http://localhost/Proyecto_Cloudware_v2/imagenes/imagenEditar.png"></a></div></td>
    <td><div class="box"><a href="vehiculos/views_vehiculos/eliminar_confirmacion.php?matricula=' . $fila['matricula'] . '&modelo=' . $fila['modelo'] . '&estado=' . $fila['estado'] . '"><img class="icnEliminar" img id="imagenTabla" src="http://localhost/Proyecto_Cloudware/imagenes/imagenBorrar.png"></a>
    </div></td>
    <td>
    <div class="box">
    <a href="http://localhost/Proyecto_Cloudware_v2/vehiculos/views_vehiculos/vehiculo.php?matricula='
            . $fila['matricula'] . '&rol='
            . $fila['rol'] . '&estado='
            . $fila['estado'] . '
    ">
    <img class="icnEliminar" img id="imagenTabla" src="http://localhost/Proyecto_Cloudware_v2/imagenes/imagenBorrar.png"></a>
    </div>
    </td>
    </tr>';
    }
    echo "</tbody></table>";
}
?>
<button class="btnAniadir" onclick="window.location.href='vehiculos/views_vehiculos/agregar_vehiculos.html';">

    <div class="box">Agregar<img class="icnAniadir" img id="imagenTabla" src="http://localhost/Proyecto_Cloudware_v2/imagenes/imagenEditar.png" width="60px" height="60px"></div>
</button>

</div>