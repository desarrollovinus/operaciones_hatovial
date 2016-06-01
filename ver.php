<?php
session_start();
$tipo_us=$_SESSION["tipo"];
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <div id="ver">
            <div class="log">
                <div class="logo"><img src="images/logo.jpg" width="445" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Ingresa el parte que desea ver:</div>
                        <div class="campos"><input type="text" id="ver_p" name="ver_p" class="campo_ver"></div>
                        <div class="boton">
                            <input type="submit" id="bot_ver"  value="Ver" name="bot_ver" class="bot"/>
                        <input type="button" id="atras"  value="Regresar" name="atras" <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
