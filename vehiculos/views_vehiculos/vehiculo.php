<?php


session_start();
if ($_SESSION['cargo'] == "2" or $_SESSION['cargo'] == "0") {


    require_once "../../db/funciones_utiles.php";
    require_once "../controlador_vehiculos/super_controlador_vehiculos.php";

    $carga = json_decode(obtener_carga($_GET['matricula'], $_GET['rol']), true);

    //Recordatorio de agregar un control de ruta aqui 
    
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
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
        <link rel="stylesheet" href="leaflet-routing-machine.css" />

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
                    $("#map").fadeIn();
                });
            });

            $(document).ready(function() {
                $("#mostrarTabla").click(function() {
                    $("#map").hide();
                });
            });

            $(document).ready(function() {
                $("#enviar").click(function() {
                    $("#map").hide();
                });
            });
        </script>
    </head>

    <body>
        <div class="usuarioCamionero">
            <i class="fa-solid fa-user-large"></i>
            <h2>Bienvenido <?php echo $_SESSION['nombre']; ?>!</h2>
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
                                                                                                echo $_GET['matricula']; ?>
                    &rol=<?php echo $_GET['rol']; ?>&estado=<?php echo $_GET['estado']; ?>">
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
                    <form action="../controlador_vehiculos/entregar.php" method="post">


                        <?php switch ($_GET['rol']) {
                            case '1':
                        ?>
                                <thead>
                                    <tr>
                                        <th>ID lote</th>
                                        <th>Destino</th>
                                        <th>Seleccionar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($carga as $fila) {

                                        echo '<tr>
                                    <td>' . $fila['id_lote'] . '</td>

                                    <td>' . $fila['nombre_localidad'] . " " .
                                            $fila['nombre_departamento'] . '</td>
                                    <td> <input type="checkbox" id="seleccionar" name="lotes[]" value="'
                                            . $fila['id_lote'] .
                                            '">
                                    </td>
                                    </tr>';
                                    }
                                    ?>
                                </tbody>
                                <input id="opcion_entrega" type="hidden" value="Entregar lote">
                            <?php
                                break;


                            case '2':
                            ?>
                                <thead>
                                    <tr>
                                        <th>ID Paquete</th>
                                        <th>Destino</th>
                                        <th>Seleccionar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($carga as $fila) {

                                        echo '<tr>
                                    <td>' . $fila['id_paquete'] . '</td>

                                    <td>' . $fila['destino_calle'] . " " . $fila['nombre_localidad'] . " " .
                                            $fila['nombre_departamento'] . '</td>
                                    <td> <input type="checkbox" id="seleccionar" name="paquetes[]" value="'
                                            . $fila['id_paquete'] .
                                            '">
                                    </td>
                                    </tr>';
                                    }
                                    ?>
                                </tbody>
                                <input id="opcion_entrega" type="hidden" value="Entregar paquete">
                        <?php
                                break;
                        } ?>


                        <input id="btnAniadir" class="btn" type="submit" value="Entregar">
                    </form>
                </table>

            </div>


            <div class="seleccionarRuta">


                <script src="leaflet-routing-machine-3.2.12/dist/leaflet-routing-machine.js"></script>
                <link rel="stylesheet" href="leaflet-routing-machine-3.2.12/dist/leaflet-routing-machine.css">


                <div class="container">
                    <div id="map"></div>
                </div>

                <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
                <script src="leaflet-routing-machine.js"></script>

                <script>
                    var map = L.map('map', {
                        trackRezise: true
                    }).setView([-34.0, -56.1], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19
                    }).addTo(map);


                    navigator.geolocation.getCurrentPosition(function(position) {
                        var latitud = position.coords.latitude;
                        var longitud = position.coords.longitude;

                        map.setView([latitud, longitud], 13);


                        var marker = L.marker([latitud, longitud], {

                        }).addTo(map);
                        marker.bindPopup("Mi ubicacion").openPopup()

                        //Switch que se encarga de marcar la ruta /los paquetes
                        <?php
                        switch ($_GET['rol']) {
                            case '1':
                        ?>
                                L.Routing.control({
                                    waypoints: [
                                        L.latLng(latitud, longitud),
                                        L.latLng(-34.6792, -56.949)
                                    ],
                                    routeWhileDragging: true
                                }).addTo(map);

                                <?php
                                foreach ($carga as $fila) {
                                    //aqui se vera las almacenes a visitar y decidir la ruta que se debe seleccionar


                                }
                                ?>
                                //aqui va el codigo para marcar la ruta en el mapa

                                <?php
                                break;

                            case '2':

                                foreach ($carga as $fila) {
                                    $destino =
                                        $fila['destino_calle'] . " " .
                                        $fila['nombre_localidad'] . " " .
                                        $fila['nombre_departamento'];
                                ?>
                                    //aqui se pondran puntos en el mapa por cada paquete a entregar segun $destino
                                    var urlDestino = 'https://nominatim.openstreetmap.org/search?format=json&q=' +
                                        encodeURIComponent("<?php echo $destino; ?>");

                                    fetch(urlDestino)
                                        .then(function(response) {
                                            return response.json();
                                        })
                                        .then(function(data) {
                                            if (data.length > 0) {
                                                var lat = parseFloat(data[0].lat);
                                                var lon = parseFloat(data[0].lon);
                                                var marker = L.marker([lat, lon], {}).addTo(map);
                                            } else {
                                                alert('No se encontró la locacion');
                                            }
                                        })
                        <?php
                                }
                                break;
                        }
                        ?>
                    });
                </script>


            </div>
        </div>
    </body>

    </html>

<?php
}
?>