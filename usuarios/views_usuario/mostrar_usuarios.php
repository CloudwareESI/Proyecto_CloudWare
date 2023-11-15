<?php
require "../../db/db_conn.php";

$base_datos = new base_de_datos();

$query = "SELECT * FROM vehiculo v WHERE rol='1'";
$resultado = $base_datos->conexion()->execute_query($query);
$matriz = $resultado->fetch_all(MYSQLI_ASSOC);

$data = file_get_contents("php://input");
$valores = json_decode($data, true);

$x = 0;
if ($valores["0"] == null) {
    echo "ERROR JSON VACIO";
} else {

    if (array_key_exists('CONFIRMAR', $_POST)) {
        eliminar();
    }
    function eliminar()
    {
        include "../../db/funciones_utiles.php";
        require_once("../controlador_usuario/super_controlador_usuario.php");
        $a = $_GET['id'];
        $id = array($a);
        del_persona($id);
    }



    echo "<script src='Js/popUp.js'></script>
    <div class='contenedorTablas'>";
    echo "<h3>Backoffice de usuarios</h3>
    <div class='tabla'>
    <table>
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
    foreach ($valores["0"] as $fila) {
        echo '
        <tr>
    <td>' . $fila['id_empleado'] . '</td>  
    <td>' . $fila['nombre'] . '</td>
    <td>' . $fila['apellido'] . '</td>
    <td>' . $fila['email'] . '</td><td>';





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
            case '4':
                echo "CRECOM";
                break;
            default:
                echo $fila['cargo'];
                break;
        }
        echo '
        </td>
        <td>'; ?>


        <button class="abrir" data-index="modificar<? echo $x; ?>"><i class="fas fa-wrench"></i></button>
        <div class="contenedorModal" data-index="modificar<? echo $x; ?>">
            <div class="modal">
                <?php
                $variables = $valores["0"][$x]; ?>
                <div class="contenedorFormulario">

                    <form class="formBase" action="usuarios/controlador_usuario/agregar_usu.php" method="post">
                        <h2>Modificacion de datos</h2>
                        <div class="formulario">
                            <div class="formularioPopUp1">
                                <input type="hidden" name="op" value="modificar">
                                <input type="hidden" name="id" value="<?= $variables['id_empleado'] ?>">
                                <input type="hidden" name="viejo" value="<?= $variables['email'] ?>">


                                <div class="formularioModificar">
                                    <?= "<p>Nombre actual: " . $variables['nombre'] . "</p>" ?>
                                    <label for="nombre">Nuevo nombre:</label>
                                    <input type="text" name="nombre">
                                </div>

                                <div class="formularioModificar">

                                    <?= "<p>Apellido actual: " . $variables['apellido'] . "</p>" ?>

                                    <label for="apellido">Nuevo apellido:</label>

                                    <input type="text" name="apellido">

                                </div>
                                <div class="formularioModificar">

                                    <?= "<p>Mail actual: " . $variables['email'] . "</p>" ?>

                                    <label for="apellido">Nuevo email:</label>

                                    <input type="text" name="email">

                                </div>

                                <div class="formularioModificar">

                                    <?= "<p>CI actual" . $variables['CI'] . "</p>" ?>

                                    <label for="apellido">CI:</label>

                                    <input type="text" name="CI">

                                </div>
                            </div>
                            <div class="formularioPopUp2">
                                <div class="formularioModificar">

                                    <?= "<p>Telefono actual" . $variables['nro_telefono'] . "</p>" ?>

                                    <label for="apellido">telefono:</label>

                                    <input type="text" name="telefono">

                                </div>

                                <div class="formularioModificar">

                                    <?= "<p>Insertar nueva contraseña</p>" ?>

                                    <label for="apellido">Nueva Contraseña:</label>

                                    <input type="text" name="password">

                                </div>

                                <div class="formularioModificar">

                                    <?php echo "<p> Cargo actual: ";
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
                                        case '4':
                                            echo "CRECOM";
                                            break;
                                        default:
                                            echo $fila['cargo'];
                                            break;
                                    }
                                    echo "</p>"; ?>

                                    <label for="cargo">Cargo:</label>

                                    <select name="cargo">
                                        <option value="0">
                                            Admin
                                        </option>
                                        <option value="2">
                                            Almacenero
                                        </option>
                                        <option value="3">
                                            Camionero
                                        </option>
                                        <option value="4">
                                            Crecom
                                        </option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="contenedorBtn">
                            <button type="button" class="cerrar">Cancelar</button>
                            <input id="btn" type="submit" value="Actualizar">
                        </div>

                    </form>
                </div>

            </div>
        </div>


        </div>
        </div>

        <?php echo '
   
        </td>
        <td>'; ?>

        <button class="abrir" data-index="eliminar<? echo $x; ?>"><i class="fas fa-trash"></i></button>
        <div class="contenedorModal" data-index="eliminar<? echo $x; ?>">
            <div class="modal">

                <?php
                $variables = $valores["0"][$x];
                echo '<h2>Eliminar a ' . $variables['nombre'] . ' ' . $variables['apellido'] . '</h2><br>
                <p>¿Esta seguro que desea eliminar al usuario ' .
                    $variables['nombre'] . ' ' . $variables['apellido'] . '?</p><br>';

                echo '
            <div class="contenedorBtn">
            <button type="button" class="cerrar">Cancelar</button>

            <form action="usuarios/controlador_usuario/agregar_usu.php" method="post">
                <input type="hidden" name="op" value="eliminar">
                <input type="hidden" name="id" value="' . $variables["id_empleado"] . '">
                <input id="CONFIRMAR" type="submit" name="CONFIRMAR" class="CONFIRMAR" value="CONFIRMAR" />
            </form>

            </div>
            ';

                ?>


            </div>
        </div>

<?php echo '</td>
</tr>';
        $x = $x + 1;
    }
    echo "</tbody></table></div>";
}


//Popup agregar
?>

<div class="btn">
    <button id="btnTabla" class="abrir" data-index="agregar">
        Agregar
    </button>
</div>

<div class="contenedorModal" data-index="agregar">
    <div class="modal">

        <div class="contenedorFormulario ">


            <form class="formBase" action="usuarios/controlador_usuario/agregar_usu.php" method="post">
                <h2>Agregar datos</h2>
                <div class="formulario">
                    <div class="formularioPopUp1">
                        <input type="hidden" name="op" value="agregar">
                        <div class="formularioModificar">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre">
                        </div>
                        <div class="formularioModificar">
                            <label for="apellido">Apellido:</label>
                            <input type="text" name="apellido">
                        </div>
                        <div class="formularioModificar">
                            <label for="apellido">Email:</label>
                            <input type="text" name="email">
                        </div>
                        <div class="formularioModificar">

                            <label for="apellido">Contraseña:</label>
                            <input type="text" name="password">
                        </div>
                    </div>


                    <div class="formularioPopUp2">
                        <div class="formularioModificar">
                            <label for="apellido">Numero de telefono:</label>
                            <input type="text" name="telefono">
                        </div>

                        <div class="formularioModificar">

                            <label for="CI">Cedula de identidad:</label>
                            <input type="text" name="CI">
                        </div>

                        <div class="formularioModificar">

                            <label for="cargo">Cargo:</label>
                            <select name="cargo">
                                <option value="0">
                                    Admin
                                </option>
                                <option value="2">
                                    Almacenero
                                </option>
                                <option value="3">
                                    Camionero
                                </option>
                                <option value="4">
                                    Crecom
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="contenedorBtn">
                    <button type="button" class="cerrar">Cancelar</button>
                    <input id="btn" type="submit" value="Agregar">
                </div>
            </form>
        </div>



    </div>
</div>







</div>


<?php
if ($valores == null) {
    echo "ERROR JSON VACIO";
} else {
    echo "<br><br><br><div class='contenedorTablas'>";
    echo "<h3>Gestion camioneros</h3>
    <div class='tabla'>
    <table>
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
    foreach ($valores["0"] as $fila) {
        if ($fila['cargo'] == "2") {


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
    echo "</tbody></table></div>";
    echo '<br>';
    echo '
<div class="selectBoton">
    <select name="matricula">';
    foreach ($valores["1"] as $fila) {
        echo "<option value='" . $fila["matricula"] . "'>"
            . $fila["matricula"] .
            "</option>";
    }

    echo '</select>
   
   
    <input id="btnSelectBoton"  type="submit" value="Asignar en camion">


    </form>  </div>';
}
?>
</div>
</div>

<?php
if ($valores["0"] == null) {
    echo "ERROR JSON VACIO";
} else {
    echo "<br><br><br><div class='contenedorTablas'>";
    echo "<h3>Gestion Almaceneros</h3>
    <div class='tabla'>
    <table>
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
    <input type="hidden" name="op" value="asignar_almacen">';
    foreach ($valores["0"] as $fila) {
        if ($fila['cargo'] == "1") {


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
    echo "</tbody></table></div>";
    echo '<br>';
    echo '<div class="selectBoton">
    <select name="almacen">';
    foreach ($valores["2"] as $fila) {
        echo "<option value='" . $fila["id_almacen"] . "'> Almacen:"
            . $fila["id_almacen"] . "-" . $fila["nombre_localidad"] .
            " " . $fila["nombre_departamento"] .
            "</option>";
    }

    echo '</select>
   
  
    <input id="btnSelectBoton2" type="submit" value="Asignar empleado/s a almacen">
 
    </form></div>';
}
?>

</div>
</div>