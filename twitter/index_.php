<?php
//date_default_timezone_set('America/Bogota');

//Inicio la session, para verificar si el usuario esta logueado, de lo contrario se devuelve al index.php
//session_start();

$pagina_web = "http://www.hatovial.com";
$pagina_web_quick = "http://www.hatovial.com/site_web_quickpass/";

//Se definen los mensajes que se podran enviar

$mensaje18 = "Quickpass 1/2: del 16 al 18 de octubre no habrá recargas por mejoras al sistema. Próximamente, 7 peajes para pago Quickpass.";
$mensaje19 = "Quickpass 2/2: Señor usuario: recargue con anticipación, previendo la actividad del 16 al 18 de octubre.";
$mensaje16 = "Hasta el 13 de noviembre, la vía Solla - Glorieta Niquía (ambos sentidos) estará en rehabilitación de 9 p.m. a 5 a.m.";
$mensaje17 = "La vía Solla - Glorieta Niquía se encuentra en rehabilitación. Por favor, tome la Autopista Norte";
$mensaje1 = "Las vías del Aburrá Norte (Solla - Barbosa - Donmatías) no presentan ninguna novedad. ".$pagina_web;
$mensaje2 = "Tenga presente: la línea de emergencias 24 horas es 018000 52 44 77. ".$pagina_web;
$mensaje3 = "Este espacio es usado solo como medio informativo. Si solicita mayor información, visite nuestra página web: ".$pagina_web;
$mensaje4 = "Concesión encargada de administrar, mejorar, mantener y operar la vía Solla-Barbosa-Donmatías. ".$pagina_web;
$mensaje5 = "La concesión cuenta con servicios de CCO, línea de emergencias 24 Horas, carro grúa, ambulancia. Info: ".$pagina_web;
$mensaje6 = "Instalación QuickPass: lunes a viernes 9 a.m. a 12 m. y 2 p.m. a 5 p.m. Tel: 4012277 Ext. 120 ".$pagina_web_quick;
$mensaje7 = "Instalación de tag QuickPass gratis en instalaciones de Hatovial. Detalles: 4012277 ".$pagina_web_quick;
$mensaje8 = "Sr. usuario: El Carril 3 del Peaje Niquía (ambos sentidos) es exclusivo para paso con tag QuickPass ".$pagina_web_quick;
$mensaje9 = "Los carriles 2 y 5 de Peaje Trapiche serán exclusivos para pago con tag QuickPass de lunes a viernes.";
$mensaje10 = "Punto de instalación Quick Pass 1/5: Hatovial SAS - lunes a viernes 8am-12m y 2pm-5pm. Calle 59 # 48-35, Copacabana";
$mensaje11 = "Punto de instalación Quick Pass 2/5: Texaco (Peaje El Trapiche), lunes a miércoles 2pm-5pm; viernes a sábado 2pm-5pm";
$mensaje12 = "Punto de instalación Quick Pass 3/5: Estación de servicio ESSO Cocorolló. Autopista Norte Km 20, sentido Medellín-Barbosa";
$mensaje13 = "Punto de instalación Quick Pass 4/5: Estación de servicio Zeuss. Calle 104 # 01-401 Km 18, Autopista Norte-Copacabana";
$mensaje14 = "Punto de instalación Quick Pass 5/5: Car Center, Centro Comercial Oviedo. Carrera 43B # 6 Sur-140, Medellín";
$mensaje15 = "Las vías del Aburrá Norte (Solla - Barbosa - Donmatías) presentan alto flujo vehicular. Transite con precaución";

// $semana_santa1 = "Peregrinos del Se&ntilde;or Ca&iacute;do, por favor usar el and&eacute;n y los puentes peatonales. #SemanaSanta";
// $semana_santa2 = "Peregrinos, les recordamos que el acceso a Girardota se har&aacute; por la v&iacute;a provisional. #SemanaSanta";
// $semana_santa3 = "Se&ntilde;or usuario, por favor tenga en cuenta que hay peregrinos en la v&iacute;a. #SemanaSanta";
?>

<html>
    <head>
        <?php
        //Inicio la session, para verificar si el usuario esta logueado, de lo contrario se devuelve al index.php
        session_start();
        $log = $_SESSION["log"];
        if ($log == 0){
            session_destroy();
        ?>
        <meta HTTP-EQUIV="REFRESH" content="0; url=../index.php">
        <?php
        }
        
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
            document.getElementById("tweet5").checked = false;
            document.getElementById("tweet6").checked = false;
            document.getElementById("tweet7").checked = false;
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
                                    <option value="trabajos de modernización del peaje Niquía">Trabajos en el peaje Niquía</option>
                                    <option value="congestión en el Peaje Niquía">Congestión en Peaje Niquía</option>
                                    <option value="congestión en el Peaje Trapiche">Congestión en Peaje Trapiche</option>
                                </select>
                            </td>
                        </tr>

                        <tr align="center">
                            <td colspan="10" style="padding: 15px"><b><font size="2">ENVIAR UNA PUBLICACI&Oacute;N SELECCIONANDO UNO DE LOS MENSAJES PREDEFINIDOS</font></b></td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet18" value="<?php echo $mensaje18; ?>">
                                <?php echo $mensaje18; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet19" value="<?php echo $mensaje19; ?>">
                                <?php echo $mensaje19; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet16" value="<?php echo $mensaje16; ?>">
                                <?php echo $mensaje16; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet17" value="<?php echo $mensaje17; ?>">
                                <?php echo $mensaje17; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet1" value="<?php echo $mensaje1; ?>">
                                <?php echo $mensaje1; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet15" value="<?php echo $mensaje15; ?>">
                                <?php echo $mensaje15; ?>
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
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet6" value="<?php echo $mensaje6; ?>">
                                <?php echo $mensaje6; ?>
                            </td>
                        </tr>
						<tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet7" value="<?php echo $mensaje7; ?>">
                                <?php echo $mensaje7; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet8" value="<?php echo $mensaje8; ?>">
                                <?php echo $mensaje8; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet9" value="<?php echo $mensaje9; ?>">
                                <?php echo $mensaje9; ?>
                            </td>
                        </tr>

                        <tr align="center">
                            <td colspan="10" style="padding: 15px"><b><font size="2">PUNTOS DE INSTALACIÓN QUICKPASS</font></b></td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet10" value="<?php echo $mensaje10; ?>">
                                <?php echo $mensaje10; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet11" value="<?php echo $mensaje11; ?>">
                                <?php echo $mensaje11; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet12" value="<?php echo $mensaje12; ?>">
                                <?php echo $mensaje12; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet13" value="<?php echo $mensaje13; ?>">
                                <?php echo $mensaje13; ?>
                            </td>
                        </tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet14" value="<?php echo $mensaje14; ?>">
                                <?php echo $mensaje14; ?>
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