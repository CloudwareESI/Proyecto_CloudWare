<?php


session_start();
if($_SESSION['rol'] == "2" OR $_SESSION['rol'] == "0"){

}
require_once "../../db/funciones_utiles.php";
require_once "../controlador_vehiculos/super_controlador_vehiculos.php";

$carga = json_decode(obtener_carga($_GET['matricula'], $_GET['rol']), true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/jpg" href="Imagenes/Logo_quickcarry-sin-fondo.png">
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>QuickCarry</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#mostrarTabla").click(function() {
                $("#tablaCarga").fadeIn();
                $("#btnAniadir").fadeIn();
            });
        });

        $(document).ready(function() {
            $("#seleccionarRuta").click(function() {
                $("#tablaCarga").hide();
                $("#btnAniadir").hide();
            });
        });
        $(document).ready(function() {
            $("#enviar").click(function() {
                $("#tablaCarga").hide();
                $("#btnAniadir").hide();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#seleccionarRuta").click(function() {
                $("#formRuta").fadeIn();
            });
        });

        $(document).ready(function() {
            $("#mostrarTabla").click(function() {
                $("#formRuta").hide();
            });
        });
        $(document).ready(function() {
            $("#enviar").click(function() {
                $("#formRuta").hide();
            });
        });
    </script>
</head>

<body>
    <div class="usuarioCamionero">
        <i class="fa-solid fa-user-large"></i>
        <h2>Bienvenido <?php echo $_SESSION['nombre'];?>!</h2>
    </div>
    <div class="todito">
        <div class="opciones">

            <div class="opcion">
                <a id="seleccionarRuta" href="#"><i class="fa-solid fa-road"></i></a>
                <h2>Seleccionar ruta</h2>
            </div>

            <div class="opcion">
                <a id="mostrarTabla" href="#"><i class="fa-solid fa-folder-open"></i></a>
                <h2>Contenido del camion</h2>
            </div>
            <div class="opcion">
                <a id="enviar" href="../controlador_vehiculos/extra_vehiculo.php?matricula=<?php 
                echo $_GET['matricula'];?>
                &rol=<?php echo $_GET['rol'];?>&estado=<?php echo $_GET['estado'];?>">
                <i class="fa-solid fa-truck-fast"></i></a>
                <h2>
                    <?php
                    switch ($_GET['estado']) {
                        case '1':
                            echo "Poner en marcha";
                            break;
                        case '0':
                            echo "Parar";
                            break;
                    }
                    ?>
                </h2>
            </div>
        </div>

        <div class="tablaInterfazCamionero">


            <table id="tablaCarga">
                <?php
                echo '<form action="../controlador_vehiculos/entregar.php" method="post">';
                ?>
                <thead>
                    <tr>
                        <th>ID lote</th>
                        <th>Destino</th>
                        <th>Entregar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($carga as $fila) {

                        echo '<tr>
                        <td>' . $fila['id_lote'] . '</td>

                        <td>' . $fila['nombre_localidad'] . " " . $fila['nombre_departamento'] . '</td>
                        <td> <input type="checkbox" id="seleccionar" name="lotes[]" value="'
                            . $fila['id_lote'] .
                            '">
                        </td>
                    </tr>';
                    }
                    ?>
                </tbody>
                <?php
                echo '</select>
                <input id="btnAniadir" type="submit" value="Cargar en camion">
                </form>
                ';
                ?>
            </table>

        </div>


        <div class="seleccionarRuta">
            <form id="formRuta" action="">
                <label for="ruta">Ruta</label>
                <select name="pais" id="pais">
                    <option value="ruta 1">ruta 1</option>
                    <option value="ruta 2">ruta 2</option>
                    <option value="ruta 3">ruta 3</option>
                </select>
                <div class="btn">
                    <button>Ingresar</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>