<?php
require "../../db/db_conn.php";

$base_datos = new base_de_datos();

$query = "SELECT * FROM vehiculo v WHERE rol='1'";
$resultado = $base_datos->conexion()->execute_query($query);
$matriz = $resultado->fetch_all(MYSQLI_ASSOC);

$data = file_get_contents("php://input");
$valor = json_decode($data, true);


if ($valor == null) {
    echo "ERROR JSON VACIO";
} else {
    echo "<div class='contenedorUsuario'>";
    echo "<h3>Backoffice de usuarios</h3>
    <table class='tablaUsuario'>
    <thead>
    <tr>
    <th>ID</th> 
    <th>Nombre</th> 
    <th>Apellido</th> 
    <th>Email</th> 
    <th>Cargo</th> 
    <th>Modificar</th> 
    <th>Eliminar</th> 
    </tr>
    </thead><tbody>";
    foreach ($valor as $fila) {
        echo '
        <tr>
    <td>' . $fila['id_empleado'] . '</td>  
    <td>' . $fila['nombre'] . '</td>
    <td>' . $fila['apellido'] . '</td>
    <td>' . $fila['email'] . '</td>
    <td>';

        switch ($fila['cargo']) {
            case '0':
                echo "Administrador";
                break;
            case '1':
                echo "Almacenero";
                break;
            case '2':
                echo "Camionero";
                break;

            default:
                # code...
                break;
        }



        echo '</td>
    <td><div class="box"><a href="usuarios/views_usuario/modificar_usuario.php?nombre=' .
            $fila['nombre'] .
            '&apellido=' . $fila['apellido'] .
            '&id=' . $fila['id_empleado'] .
            '&email=' . $fila['email'] .
            '">
    <img class="icnModificar" img id="imagenTabla" src="http://localhost/Proyecto_Cloudware/imagenes/imagenEditar.png">
        </a>
        </div>
        </td>
       
       
        <td>
   
        </td>
    <td>
    <div class="box">
    <a href="usuarios/views_usuario/eliminar_confirmacion.php?nombre=' . $fila['nombre'] .
            '&apellido=' . $fila['apellido'] .
            '&id=' . $fila['id_empleado'] .
            '">
    <img class="icnEliminar" img id="imagenTabla" src="http://localhost/Proyecto_Cloudware/imagenes/imagenBorrar.png">
    </a>
    </div>
    </td>
    </tr>
    ';
    }
    echo "</tbody></table>";
}
?>
<div class="botonUsuario">
    <button onclick="window.location.href='usuarios/views_usuario/agregar_usuario.html';">
        Agregar
    </button>
</div>
</div>
</div>

<?php
if ($valor == null) {
    echo "ERROR JSON VACIO";
} else {
    echo "<div class='contenedorUsuario'>";
    echo "<h3>Gestion camioneros</h3>
    <table class='tablaUsuario'>
    <thead>
    <tr>
    <th>ID</th> 
    <th>Nombre</th> 
    <th>Apellido</th> 

    <th>Asignar</th> 
    </tr>
    </thead><tbody>";
    
    echo '
    <form action="usuarios/controlador_usuario/agregar_usu.php" method="post">
    <input type="hidden" name="op" value="asignar_vehiculo">';
    foreach ($valor as $fila) {
        if($fila['cargo'] == "2"){


        echo '
        <tr>
    <td>' . $fila['id_empleado'] . '</td>  
    <td>' . $fila['nombre'] . '</td>
    <td>' . $fila['apellido'] . '</td>
    <td> <input type="checkbox" id="seleccionar" name="id_empleado[]" value="'
    . $fila['id_empleado'] .
    '">
    </td>
   
    </tr>
    ';
    }
}
    echo "</tbody></table>";
    echo '<select name="matricula">';
    foreach ($matriz as $fila) {
        echo "<option value='" . $fila["matricula"] . "'>"
            . $fila["matricula"] .
            "</option>";
    }

    echo '</select>
    <input class="btnAniadir" type="submit" value="Cargar en camion">
    </form>';
}
?>
</div>
</div>