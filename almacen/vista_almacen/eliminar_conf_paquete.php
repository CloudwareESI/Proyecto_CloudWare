<div class="contenedor">
    <div class="subcontenedor">
        <h1>Eliminar Paquete</h1>
        <?php
        echo '<h4>¿Esta seguro que desea eliminar al vehiculo ' . $_GET['nombre_paquete'] . ' ' . $_GET['id_paquete'] . ' ?</h4>';
        ?>

        <?php
        if (array_key_exists('CONFIRMAR', $_POST)) {
            eliminar();
        }
        function eliminar()
        {
            include "../../db/funciones_utiles.php";
            require_once("../controlador_almacen/super_controlador_almacen.php");
            $a = $_GET['id_paquete'];
            $id = array($a);
            del_paquete($id);

            header("Location:http://localhost/Proyecto_Cloudware_v2/Index.php?Almacen");
        }
        ?>

        <form method="post">
            <input type="submit" name="CONFIRMAR" class="CONFIRMAR" value="CONFIRMAR" />
        </form>
    </div>
</div>