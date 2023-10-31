<?php

$data = file_get_contents("php://input");
$valor = json_decode($data, true);


if ($valor == null) {
    echo "ERROR JSON VACIO";
} else {
    echo "<div class='contenedorTablas'><h3>Backoffice de Rutas</h3><table><tr>";
    foreach ($valor as $subvalor) {



        echo "<table>
        <thead>
        <tr>
        <th>Runta N°" . $subvalor[0]['id_ruta'] . "</th> 
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
                src="http://localhost/Proyecto_Cloudware/imagenes/imagenEditar.png"></a></div></td>
            <td><div class="box">
            <a href="vehiculos/views_vehiculos/eliminar_ruta.php?id=' .
                $fila['id_ruta'] . '"><img class="icnEliminar" img id="imagenTabla" 
                src="http://localhost/Proyecto_Cloudware/imagenes/imagenBorrar.png"></a>
                </div></td>
                </tr>';
        }
        echo "</tbody></table><br>";
    }
}
?>

<form action="vehiculos/views_vehiculos/agregar_ruta.php" method="POST">
<input class="btnAniadir" type="submit" value="Agregar una ruta">
<input type="number" name="ubicaciones">
</form>

</div>