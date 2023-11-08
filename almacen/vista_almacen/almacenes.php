<?php

$data = file_get_contents("php://input");



$valor = json_decode($data, true);

var_dump($valor);

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
    <th>Seleccionar</th> 
    </tr></thead><tbody>";
    foreach ($almacenes as $fila) {
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
    </div></td>
    </tr>';
    }
    echo "</tbody></table></div>";
}
?>

</div>