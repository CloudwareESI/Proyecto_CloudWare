<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/jpg" href="../../Imagenes/Logo_quickcarry-sin-fondo.png">
    <link rel="stylesheet" href="../../estilos/estiloDef.css">
    <title>QuickCarry</title>
</head>

<body>
    <div class="contenedorFormulario">

        <form action="../controlador_vehiculos/agregar_vehiculos.php" method="post">

            <div class="formulario">
                <h2>Modificacion de datos</h2>
                <input type="hidden" name="op" value="modificar">
                <input type="hidden" name="matricula_vieja" value="<?= $_GET['matricula'] ?>">

                <?= "<p>Matricula actual: " . $_GET['matricula'] . "</p>" ?>

                <label for="matricula">Nueva matricula:</label>

                <input type="text" name="matricula"><br>


                <?php echo "<p>Estado actual: ";
                switch ($_GET['estado']) {
                    case '1':
                        echo "Detenido";
                        break;
                    case '0':
                        echo "En marcha";
                        break;
                    case '2':
                        echo "Dañado";
                        break;
                }
                echo "</p>"; ?>

                <label for="estado">Nuevo estado:</label>

                <select name="estado">
                    <option value="0">
                        Detenido
                    </option>
                    <option value="1">
                        En marcha
                    </option>
                    <option value="2">
                        Dañado
                    </option>
                </select>


                <?= "<p>Modelo actual: " .
                    $_GET['modelo'] .
                    "</p>" ?>

                <label for="modelo">Nuevo modelo:</label>

                <input type="text" name="modelo"><br><br>


                <?php echo "<p>Rol actual: ";
                switch ($_GET['rol']) {
                    case '1':
                        echo "Camion";
                        break;
                    case '2':
                        echo "Camioneta";
                        break;
                    default:
                        echo "N/A";
                        break;
                }

                echo "</p>" ?>

                <label for="rol">Nuevo Rol:</label>
                <select name="rol">
                    <option value="1">
                        Camion
                    </option>
                    <option value="2">
                        Camioneta
                    </option>
                </select>

                <div class="btn">
                    <input id="btn" type="submit" value="Actualizar">
                </div>
            </div>
    </div>
</body>

</html>