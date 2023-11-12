<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/jpg" href="../../Imagenes/Logo_quickcarry-sin-fondo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <?php switch ($_SESSION["color"]) { 
        case 'negro':
            ?>
            <link rel="stylesheet" href="../../estilos/estiloDef.css">
            <?php
            break;
        case 'blanco':
            ?>
            <link rel="stylesheet" href="../../estilos/estiloColor.css">
            <?php
            break; } 
    ?>
    <title>QuickCarry</title>
</head>

<body>
<header>
        <div class="home">
           <a href="../../index.php"><i class="fa-solid fa-reply"></i></a>
        </div>
    </header>

<div class="contenedorFormulario">
    <form class="formBase" action="../controlador_usuario/control_verificacion.php" method="post">

        <div class="formulario vertical">

        <?php switch ($_SESSION["color"]) { 
            case 'negro':
                echo     
                '<img src="../../Imagenes/Logo_quickcarry-sin-fondo1.png" alt="logo" height="70px" width="70px">'; 
                break;
            case 'blanco':
                echo     
                '<img src="../../Imagenes/Logo_quickcarry-VERDE.png" alt="logo" height="70px" width="70px">';
                break; } 
        ?>
            

            <h2>Iniciar sesion</h2>

            <br>
            <div>
                <input type="text" class="controles" name="mail" id="mail" placeholder="Mail:" maxlength="32" required
                    name="Usuario:">
                <label for="myInput" id="myLabel">Usuario:</label>
            </div>

      

            <div>
                <input type="password" class="controles" name="password" id="password" placeholder="Contraseña:" maxlength="15" required>
                <label for="myInput" id="myLabel">Contraseña:</label>
            </div>
        
        
            <div class="btn">
                <button>Ingresar</button>
            </div>


    </form>
    </div>
</div>
</body>

</html>