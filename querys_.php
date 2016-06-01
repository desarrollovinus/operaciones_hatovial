<?php
session_start();

$log=$_SESSION["log"];
if ($log==0){
    session_destroy();
     ?><meta HTTP-EQUIV="REFRESH" content="0; url=index.php"><?php
}

?>

<html>
<head>
    <title>Consulta Bitacora</title>
    <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
</head>
<body>
<?php
   
include("funciones.php");
  
?>
    <center>
        
    <form action="bitacora.php" name="frmbit" id="frmbit" enctype="multipart/form-data" method="post" >

    
    <div id="botonera">
    <input type="submit" id="nueva_bit" name="nueva_bit" value="Nueva Bitacora" class="button"  >
    <input type="button" id="imp_bit" name="imp_bit" value="Imprimir" onclick="location.href='./imp_bit.php'" class="button">
    <input type="button" id="informes" name="informes" value="Informes" onclick="location.href='./informes.php'" class="button">
    <input type="button" id="ver" name="ver" value="Ver todo" onclick="location.href='./bit_comp.php'" class="button">
    <input type="button" id="ver_parte" name="ver_parte" value="Ver Parte" onclick="location.href='./ver.php'" class="button">
    <input type="button" id="salir" name="salir" value="Salir" onclick="location.href='./salir.php'" class="button">
    </div>
        <?php
        if (isset($_REQUEST['pos']))
          $inicio=$_REQUEST['pos'];
        else
          $inicio=0;
        $impresos=0;

    $link=Conectarse();  $result=mysql_query("select * from tbl_bitacora order by consecutivo desc limit $inicio, 200",$link);
       
      $tabla='<TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1 width="1055px">
        <TR><TD>&nbsp;<b>CONSECUTIVO</b></TD><TD>&nbsp;<b>MOTIVO</b>&nbsp;</TD>
        <TD>&nbsp;<b>FECHA Y HORA</b>&nbsp;</TD><TD>&nbsp;<b>ASUNTO</b>&nbsp;</TD>
        <TD>&nbsp;<b>ANOTACION</b>&nbsp;</TD></TR>';

   while($row = mysql_fetch_array($result)) {
       $impresos++;
       if(empty($row["consecutivo"])){ $row["consecutivo"]="&nbsp;"; }
       if(empty($row["motivo"])){ $row["motivo"]="&nbsp;"; }
       if(empty($row["fechahora"])){ $row["fechahora"]="&nbsp;"; }
       if(empty($row["asunto"])){ $row["asunto"]="&nbsp;"; }
       if(empty($row["anotacion"])){ $row["anotacion"]="&nbsp;"; }

       $tabla .='<tr><td>'.$row["consecutivo"].'</td><td>'.$row["motivo"].'</td><td>'.$row["fechahora"].'</td><td>'.$row["asunto"].'</td><td>'.$row["anotacion"].'</td></tr>';
      
   }
   
   mysql_close($link);

if ($inicio==0)
  echo "<font size='3'>Anterior </font> ";
else
{
  $anterior=$inicio-200;
  echo "<a href=\"querys.php?pos=$anterior\"><font size='3' color='dodgerblue'>Anterior </font></a>";
}
if ($impresos==200)
{
  $proximo=$inicio+200;
  echo "<a href=\"querys.php?pos=$proximo\"><font size='3' color='dodgerblue'>Siguiente </font></a> <br>";
}
else
  echo "<font size='3'>Siguiente</font> <br>";
echo $tabla;
?>
    </form>
    </center>
</body>
</html>


