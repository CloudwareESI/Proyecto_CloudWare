<div class="contenedor">
    <div class="subcontenedor">
        <h1>Eliminar Vehiculo</h1>
        <?php
        echo '<h4>¿Esta seguro que desea eliminar al vehiculo ' . $_GET['modelo'] . ' ' . $_GET['matricula'] . ' ?</h4>';
        ?>

        <?php
        if (array_key_exists('CONFIRMAR', $_POST)) {
            eliminar();
        }
        function eliminar()
        {
            include "../../db/funciones_utiles.php";
            require_once("../controlador_vehiculos/super_controlador_vehiculos.php");
            $a = $_GET['matricula'];
            $id = array($a);
            del_vehiculos($id);

            header("Location:http://localhost/Proyecto_Cloudware_v2/index.php");
        }
        ?>

        <form method="post">
            <input type="submit" name="CONFIRMAR" class="CONFIRMAR" value="CONFIRMAR" />
        </form>
    </div>
</div>