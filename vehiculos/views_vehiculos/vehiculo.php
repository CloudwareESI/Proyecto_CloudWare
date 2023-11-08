<?php


session_start();
if ($_SESSION['cargo'] == "2" or $_SESSION['cargo'] == "0") {


    require_once "../../db/funciones_utiles.php";
    require_once "../controlador_vehiculos/super_controlador_vehiculos.php";

    $vehiculo = get_vehiculo(array($_GET['matricula']))[0];

    $carga = obtener_carga($_GET['matricula'], $vehiculo['rol']);

    $destino = $carga['3'];
    var_dump($destino);

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="icon" type="image/jpg" href="../../../Imagenes/Logo_quickcarry-sin-fondo.png">
        <link rel="stylesheet" href="../../estilos/estiloDef.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <title>QuickCarry</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

        <link rel="stylesheet" href="../../leaflet-routing-machine-3.2.12/dist/leaflet-routing-machine.css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>




        <script>
            $(document).ready(function() {
                $("#mostrarTabla").click(function() {
                    $("#tablaCarga").fadeIn();
                    $("#btn").fadeIn();
                });
            });

            $(document).ready(function() {
                $("#seleccionarRuta").click(function() {
                    $("#tablaCarga").hide();
                    $("#btnVehiculo").hide();
                });
            });
            $(document).ready(function() {
                $("#enviar").click(function() {
                    $("#tablaCarga").hide();
                    $("#btnVehiculo").hide();
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
        <div class="contenedorInterfaz">
            <div class="usuarioCamionero">
                <i class="fa-solid fa-user-large"></i>
                <h2>Bienvenido <?php echo $_SESSION['nombre']; ?>!
                </h2>
            </div>
            <div class="contenedorOpciones">
                <div class="opciones">

                    <div class="opcion">
                        <a id="seleccionarRuta" href="#"><i class="fa-solid fa-road"></i></a>
                        <h2>Seleccionar ruta</h2>
                    </div>

                    <div class="opcion">
                        <a id="mostrarTabla" href="#"><i class="fa-solid fa-folder-open"></i></a>
                        <h2>Carga del camion</h2>
                    </div>
                    <div class="opcion">
                        <a id="enviar" href="../controlador_vehiculos/extra_vehiculo.php?matricula=<?php
                                                                                                    echo $_GET['matricula']; ?>
                        &rol=<?php echo $vehiculo['rol']; ?>&estado=<?php
                                                                    echo
                                                                    $vehiculo['estado']; ?>&opcion=marcha">
                            <i class="fa-solid fa-truck-fast"></i></a>
                        <h2>
                            <?php
                            switch ($vehiculo['estado']) {
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


                            <?php
                            if (isset($carga)) {
                                switch ($vehiculo['rol']) {
                                    case '1':
                            ?>
                                        <input type="hidden" name="opcion" value="lote">
                                        <input type="hidden" name="rol" value="<? echo $_GET['rol']; ?>">
                                        <input type="hidden" name="matricula" value="<? echo $_GET['matricula']; ?>">

                                        <thead>
                                            <tr>
                                                <th>ID lote</th>
                                                <th>Destino</th>
                                                <th>Seleccionar</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php

                                            foreach ($carga[0] as $fila) {
                                                if (!isset($fila["fecha_de_entrega"])) {

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
                                            }

                                            ?>
                                        </tbody>
                                        <input id="opcion_entrega" type="hidden" value="Entregar lote">
                                    <?php
                                        break;


                                    case '2':
                                    ?>
                                        <input type="hidden" name="opcion" value="paquete">
                                        <thead>
                                            <tr>
                                                <th>ID Paquete</th>
                                                <th>Destino</th>
                                                <th>Seleccionar</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            foreach ($carga[0]  as $fila) {
                                                if (!isset($fila["fecha_entrega"])) {
                                                    echo '<tr>
                                                <td>' . $fila['id_paquete'] . '</td>
            
                                                <td>' . $fila['destino_calle'] . " " . $fila['nombre_localidad'] . " " .
                                                        $fila['nombre_departamento'] . '</td>
                                                <td> <input type="checkbox" id="seleccionar" name="paquetes[]" value="'
                                                        . $fila['id_paquete'] .
                                                        '">
                                                </td>
                                                </tr>';
                                                };
                                            }
                                            ?>
                                        </tbody>
                                        <input id="opcion_entrega" type="hidden" value="Entregar paquete">
                            <?php
                                        break;
                                }
                            } ?>


                            <div class="btn">
                                <input id="btnVehiculo" class="btn" type="submit" value="Entregar">
                            </div>
                        </form>
                    </table>


                </div>

                <div class="contenedorRuta">

                    <div class="contenedorMapa">
                        <div id="map" class="ignore-css"></div>
                    </div>

                    <script src="../../leaflet-routing-machine-3.2.12/dist/leaflet-routing-machine.js">
                    </script>


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


                            //marca la ruta por varias posiciones



                            <?php
                            $destinos = array("Rivera 3674 Montevideo", "Schinca 2540 Montevideo");
                            foreach ($destinos as $destino) {
                            ?>



                                var urlDestino = 'https://nominatim.openstreetmap.org/search?format=json&q=' +
                                    encodeURIComponent("<?php echo $destino; ?>");

                                    obtenerCords(
                                        fetch(urlDestino))
                                    .then(function(response) {
                                        var data = response.json();
                                        if (data.length > 0) {
                                            var lat = parseFloat(data[0].lat);

                                            var lon = parseFloat(data[0].lon);

                                            L.Routing.control({
                                                waypoints: [
                                                    L.latLng(latitud, longitud),
                                                    L.latLng(lat, lon)
                                                ],
                                                routeWhileDragging: true
                                            }).addTo(map);
                                        } else {
                                            alert('No se encontró la locacion');
                                        }

                                    });


                            <?php
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