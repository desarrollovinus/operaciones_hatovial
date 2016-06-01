<?php
date_default_timezone_set('America/Bogota');

//Inicio la session, para verificar si el usuario esta logueado, de lo contrario se devuelve al index.php
session_start();

$pagina_web = "http://www.hatovial.com";

//Se definen los mensajes que se podran enviar
$mensaje1 = "Las vías del Aburrá Norte (Solla - Barbosa - Donmatías) no presentan ninguna novedad. ".$pagina_web;
$mensaje2 = "Tenga presente: la línea de emergencias 24 horas es 018000 52 44 77. ".$pagina_web;
$mensaje3 = "Este espacio es usado solo como medio informativo. Si solicita mayor información, visite nuestra página web: ".$pagina_web;
$mensaje4 = "Concesión encargada de administrar, mejorar, mantener y operar la vía Solla-Barbosa-Donmatías. ".$pagina_web;
$mensaje5 = "Nuestra concesión cuenta con servicios de C.C.O., línea de emergencias 24 Horas, carro grúa, ambulancia. Más info: ".$pagina_web;
?>

<html>
    <head>
        <?php
        //Inicio la session, para verificar si el usuario esta logueado, de lo contrario se devuelve al index.php
        session_start();
        $log=$_SESSION["log"];
        if ($log==0){
            session_destroy();
        ?>
        <meta HTTP-EQUIV="REFRESH" content="0; url=../index.php">
        <?php }
        
        //Se conecta con la base de datos
        include("../funciones.php");
        $link=Conectarse();
        $ced=$_SESSION["ced"];
        ?>
        <link href="../css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Enviar un Tweet</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <script>
        function deshabilitar(){
            document.getElementById("tweet1").checked = false;
            document.getElementById("tweet2").checked = false;
            document.getElementById("tweet3").checked = false;
            document.getElementById("tweet4").checked = false;
        }
    </script>
    </head>
    <body>
        <form action="enviar/index.php" method="post">
            <div id="contenedor-logo">
                <div class="logo"></div>
                <div id="contenedor">
                    <table width="90%" border="0" cellspacing="0" cellpadding="0" align="left" class="tabla">
                        <tr align="center">
                            <td colspan="10" style="padding: 15px"><b><font size="2">ENVIAR UNA PUBLICACI&Oacute;N SELECCIONANDO DIFERENTES OPCIONES</font></b></td>
                        </tr>
                        <tr>
                            <td>
                                <label>V&iacute;a*</label>
                                <select name="via" onChange="deshabilitar()">
                                    <option value=""></option>
                                    <option value="La vía Solla - Glorieta Niquía (Sentido Norte-Sur)">Solla - Glorieta Niqu&iacute;a Norte - Sur</option>
                                    <option value="La vía Solla - Glorieta Niquía (Sentido Sur-Norte)">Solla - Glorieta Niqu&iacute;a Sur - Norte</option>
                                    <option value="La vía Glorieta Niquía - La Frutera (Sentido Norte-Sur)">Glorieta Niqu&iacute;a - La Frutera Norte - Sur</option>
                                    <option value="La vía Glorieta Niquía - La Frutera (Sentido Sur-Norte)">Glorieta Niqu&iacute;a - La Frutera Sur - Norte</option>
                                    <option value="La vía La Frutera - Donmatías (Sentido Norte-Sur)">La Frutera - Donmat&iacute;as Norte - Sur</option>
                                    <option value="La vía La Frutera - Donmatías (Sentido Sur-Norte)">La Frutera - Donmat&iacute;as Sur - Norte</option>
                                    <option value="La vía Uniminuto - Copacabana (Sentido Norte-Sur)">Uniminuto - Copacabana Norte - Sur</option>
                                    <option value="La vía Uniminuto - Copacabana (Sentido Sur-Norte)">Uniminuto - Copacabana Sur - Norte</option>
                                    <option value="La vía Girardota - El Hatillo (Sentido Norte-Sur)">Girardota - El Hatillo Norte - Sur</option>
                                    <option value="La vía Girardota - El Hatillo (Sentido Sur-Norte)">Girardota - El Hatillo Sur - Norte</option>
                                    <option value="La vía El Hatillo - Barbosa (Sentido Norte-Sur)">El Hatillo - Barbosa Norte - Sur</option>
                                    <option value="La vía El Hatillo - Barbosa (Sentido Sur-Norte)">El Hatillo - Barbosa Sur - Norte</option>
                                    <option value="El intercambio vial El Hatillo - Barbosa (Sentido Norte-Sur)">Intercambio El Hatillo - Barbosa Norte - Sur</option>
                                    <option value="El intercambio vial El Hatillo - Barbosa (Sentido Sur-Norte)">Intercambio El Hatillo - Barbosa Sur - Norte</option>
                                </select>
                            </td>
                            <td>
                                <label>Estado*</label>
                                <select name="estado" onChange="deshabilitar()">
                                    <option value=""></option>
                                    <option value="no presenta ninguna novedad">Sin Novedad</option>
                                    <option value="presenta movilidad fluída">Movilidad Flu&iacute;da</option>
                                    <option value="presenta movilidad reducida">Movilidad Reducida</option>
                                    <option value="se encuentra en condiciones de vía húmeda">V&iacute;a H&uacute;meda</option>
                                    <option value="presenta cierre parcial">Cierre Parcial</option>
                                    <option value="presenta cierre total">Cierre Total</option>
                                </select>
                            </td>
                            <td>
                                <label>Causa(Opcional)</label>
                                <select name="causa" onChange="deshabilitar()">
                                    <option value=""></option>
                                    <option value="incidente de tránsito">Incidente de tr&aacute;nsito</option>
                                    <option value="accidente de tránsito">Accidente de Tr&aacute;nsito</option>
                                    <option value="alto flujo vehicular">Alto Flujo Vehicular</option>
                                    <option value="trabajos en la vía">Trabajos en la V&iacute;a</option>
                                    <option value="realización de evento público">Evento P&uacute;blico</option>
                                    <option value="manifestación pública">Manifestaci&oacute;n P&uacute;blica</option>
                                    <option value="realización de ciclovía">Ciclov&iacute;a</option>
                                    <option value="condiciones de lluvia">Condici&oacute;n Lluviosa</option>
                                    <option value="rehabilitación de vía">Rehabilitaci&oacute;n de v&iacute;a</option>
                                    <option value="pavimentación de vía">Pavimentaci&oacute;n de v&iacute;a</option>
                                </select>
                            </td>
                        </tr>
                        <tr align="center">
                            <td colspan="10" style="padding: 15px"><b><font size="2">ENVIAR UNA PUBLICACI&Oacute;N SELECCIONANDO UNO DE LOS MENSAJES PREDEFINIDOS</font></b></td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet1" value="<?php echo $mensaje1; ?>">
                                <?php echo $mensaje1; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet2" value="<?php echo $mensaje2; ?>">
                                <?php echo $mensaje2; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet3" value="<?php echo $mensaje3; ?>">
                                <?php echo $mensaje3; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet4" value="<?php echo $mensaje4; ?>">
                                <?php echo $mensaje4; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet5" value="<?php echo $mensaje5; ?>">
                                <?php echo $mensaje5; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 15px" align="center" colspan="10">
                                <input type="submit" id="guardar" name="guardar" class="button" value="Enviar Tweet">
                                <input type="button" name="salir" id="salir" class="button" value="Regresar" onclick="location.href='../querys.php'">
                                <a href="https://twitter.com/hatovial" target="_blank"><img src="../images/twitter2.png" style="vertical-align: middle" width="32" height="32"/></a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </form>
    </body>
</html>