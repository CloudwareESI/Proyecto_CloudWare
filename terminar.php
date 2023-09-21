<?php
   session_start();
   session_destroy(); //eliminamos la session
   header("Location:http://localhost/Proyecto_Cloudware/index.php");
?>