<?php
//Inicio de sesion
session_start();

//Se incluye el archivo de funciones
include 'funciones.php';

//Se reciben los datos necesarios 
$parte=$_POST["parte"];
$_SESSION["id_parte"] = $parte;
$carpeta = "./files/$parte";

if(!is_dir($carpeta)){
    @mkdir($carpeta, 0777);

    $tot = count($_FILES["archivos"]["name"]);
    
    for ($i = 0; $i < $tot; $i++){
        $archivo1 = $_FILES["archivos"]['name'][$i];
        $repl="_";
        $serc=" ";

        $archivo= str_replace ($serc,$repl,$archivo1);
        if ($archivo != "") {
            // guardamos el archivo a la carpeta files
            $destino =  "".$carpeta."/".$archivo;
            copy($_FILES['archivos']['tmp_name'][$i],$destino);
        }
    }
    ?>
    <script language="Javascript" type="text/javascript">
            alert ('Las fotos han subido con exito');
    </script>
    <meta HTTP-EQUIV="REFRESH" content="0; url=principal.php">
    <?php
}else{
    $tot = count($_FILES["archivos"]["name"]);
    for ($i = 0; $i < $tot; $i++){
        $archivo1 = $_FILES["archivos"]['name'][$i];
        $repl="_";
        $serc=" ";

        $archivo= str_replace ($serc,$repl,$archivo1);
        if ($archivo != "") {
            // guardamos el archivo a la carpeta files
            $destino =  "".$carpeta."/".$archivo;
            if(!is_file($destino)){
                copy($_FILES['archivos']['tmp_name'][$i],$destino);
            } 
        } 
    }
    ?>
    <script language="Javascript" type="text/javascript">
            alert ('Las fotos han subido con exito');
    </script>
    <?php
}
//Script para marcar que ya hay fotos en la base de datos
$insercion = "update tbl_accidente set fotos = 1 where id_parte = ".$parte;
mysql_query($insercion, Conectarse());
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=fotos_mod.php">