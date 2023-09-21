<div class="contenedor">
    <div class="subcontenedor">
        <h1>Eliminar Persona</h1>
        <?php
        echo '<h4>¿Esta seguro que desea eliminar a ' . $_GET['nombre'] . ' ' . $_GET['apellido'] . ' ?</h4>';
        ?>

        <?php
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

            //header("Location:http://localhost/Proyecto_Cloudware_V2/index.php");
        }
        ?>

        <form method="post">
            <input type="submit" name="CONFIRMAR" class="CONFIRMAR" value="CONFIRMAR" />
        </form>
    </div>
</div>