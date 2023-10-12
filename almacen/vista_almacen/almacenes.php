<?php

$data = file_get_contents("php://input");



$valor = json_decode($data, true);

if ($valor == null) {
    echo "ERROR JSON VACIO";
} else {
    echo "<div class='contenedor'>";
    echo "<h3>Almacenes</h3>
    <table><thead><tr>
    <td>Numero</td> 
    
    <th>Calle</th> 
    <th>Chapa</th> 
    <th>Localidad</th> 
    <th>Departamento</th> 
    <th>Acceder</th> 
    </tr></thead><tbody>";
    foreach ($valor as $fila) {
        echo '<tr>
    <td>' . $fila['id_almacen'] . '</td>  
    <td>' . $fila['calle'] . '</td> 
    <td>' . $fila['chapa'] . '</td> 
    <td>' . $fila['nombre_localidad'] . '</td> 
    <td>' . $fila['nombre_departamento'] . '</td>

    <td><div class="box"><a href="http://localhost/Proyecto_Cloudware/index.php?id_almacen=' . $fila['id_almacen'] . '
        &Almacenes=1
    ">
    
    <img class="icnEliminar" img id="imagenTabla" src="http://localhost/Proyecto_Cloudware/imagenes/imagenBorrar.png"></a>
    </div></td>
    </tr>';
    }
    echo "</tbody></table>";
}
?>

</div>