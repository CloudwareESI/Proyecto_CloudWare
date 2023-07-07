<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>BD</title>
</head>

<body>
    <div class="contenedor flex">
        <?php


        $mysqli = new mysqli("localhost", "root", "", "php"); //llama a BD
        $inst = $mysqli->query("select * from personas where empleado=1");
        if ($inst == null) {
            # code...
        } else {
            echo "<table><tr><td>ID</td> <td>Nombre</td> <td>Apellido</td> <td>Contraseña</td> <td>Email</td> <td>Modificar</td> <td>Eliminar</td> </tr>";
            foreach ($inst->fetch_all(MYSQLI_ASSOC) as $fila) {
                echo '<tr>
            <td>' . $fila['id'] . '</td>  
            <td>' . $fila['nombre'] . '</td>
            <td>' . $fila['apellido'] . '</td>
            <td>' . $fila['password'] . '</td>
            <td>' . $fila['email'] . '</td>
            <td><div class="box"><a href="php/ventanaMod.php?id=' . $fila['id'] . '"><img class="icnModificar" img id="imagenTabla" src="http://localhost/Proyecto_Cloudware/imagenes/imagenEditar.png"></a></div></td>
            <td><div class="box"><a href="php/EliminarConfirmacion.php?id=' . $fila['id'] . '"><img class="icnEliminar" img id="imagenTabla" src="http://localhost/Proyecto_Cloudware/imagenes/imagenBorrar.png"></a>
            </div></td>
            </tr>';
            }
            echo "</table>";
        }
        ?>
        <button class="btnAniadir" onclick="window.location.href='php/ventanaAgregar.php';">

            <div class="box">Agregar<img class="icnAniadir" img id="imagenTabla" src="http://localhost/Proyecto_Cloudware/imagenes/imagenEditar.png" width="60px" height="60px"></div>
        </button>


    </div>

</body>

</html>