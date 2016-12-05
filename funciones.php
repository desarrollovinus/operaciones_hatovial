<?php
function Conectarse(){
	if (!($link=mysql_connect("localhost",'root',''))){
		echo "Error conectando a la base de datos.";
		exit();
	}
	 
	if (!mysql_select_db("operaciones",$link)){
		echo "Error seleccionando la base de datos.";
		exit();
	}
                   
	return $link;
}

//-----------------------desconectarse de la B.D--------------------/
function Desconectarse(){
    $des=mysql_close($link);
    return $des;
}

function guardar(){
    $tabla=tbl_bitacora;
    $fechahora="$_POST[fecha]";
    $motivo="$_POST[com_motivo]";
    $asunto="$_POST[asunto]";
    $heridos="$_POST[com_heridos]";
    $reporto="$_POST[per_reporta]";
    $danos="$_POST[danos]";
    $ubicacion="$_POST[ubi_reportada]";
    $emisor="$_POST[emisor]";
    $importancia="$_POST[importancia]";
    $anotacion="$_POST[anotacion]";
    $campos= 'fechahora,motivo,asunto,heridos,reporto,danos,ubicacion,emisor,importancia,anotacion,';
    $query="INSERT INTO ".$tabla." ( ".$campos." ) VALUES (".$fechahora.",".$motivo.",".$asunto.",".$heridos.",".$reporto.",".$danos.",".$ubicacion.",".$emisor.",".$importancia.",".$anotacion.")";
    $exequery=mysql_query($query) or die(mysql_error());
    echo "guardo con exito";
    return true;
}

function listar24(){
    header("location: listado2.php");
}

class loginVal{
    public function ValLogin($user,$pass,$link2){
        $usuario=ReplaceChar($_POST[login]);
        $contrasena=ReplaceChar($_POST[pass]);
        $query="SELECT id_usuario, us_tipo FROM tbl_usuarios WHERE us_user='".$usuario."' and us_pass='".md5($contrasena)."' ";
        $exequery=mysql_query($query,$link);
        $row=mysql_fetch_row($exequery);
        return $row;
    }
}

require_once("datas.php");

function accidente($id_parte){
    // Consulta
    $sql = 
    "SELECT
        a.fec_con,
        a.calzada,
        a.tramo,
        a.via,
        a.abcisa,
        a.carriles_obs,
        a.descripcion
    FROM
        tbl_accidente AS a
    WHERE
        a.id_parte = $id_parte";

    return mysql_fetch_assoc(mysql_query($sql));
}

function accidente_incompleto($id_parte,$link){
    $consulta="Select * from tbl_accidente where id_parte = $id_parte";
    $result=  mysql_query($consulta,$link);
    $row = mysql_fetch_assoc($result);
    $date = explode(" ",$row["fec_pro"]);
    $hora_c = explode(" ",$row["fec_con"]);
    $hora_i = explode(" ",$row["fechahora_ini"]);
    $hora_f = explode(" ",$row["fechahora_fin"]);
	
    if($date[0]=="0000-00-00" or $row["via"]=="" or $row["tramo"]=="" or $row["calzada"]=="" or $row["abcisa"]=="" or $hora_c[0]=="0000-00-00" or $hora_i[0]=="0000-00-00" or $hora_f[0]=="0000-00-00"){
        return true;
    }

    if($row["ch_contra_veh"]=="" and $row["ch_contra_obj"]=="" and $row["atropello"]=="" and $row["volcamiento"]=="" and $row["caida_del_ocu"]=="" and $row["ch_contra_sem"]=="" and $row["otros_acc"]==""){
        return true;
    }
	
    if($row["exc_vel"]=="" and $row["imp_peat"]=="" and $row["imp_con"]=="" and $row["obs_via"]=="" and $row["falta_pre"]=="" and $row["embri"]=="" and $row["fallas"]=="" and $row["no_dis"]=="" and $row["sem_via"]=="" and $row["ade_proh"]=="" and $row["hip_otros"]==""){
        return true;
    }
	
    if(involucrados_incompletos($id_parte,$link)){
        return true;
    }
	
    if(victimas_incompletas($id_parte,$link)){
        return false;
    }
    return false;
}

function cierre($id_parte){
    // Consulta
    $sql =
    "SELECT
        c.id_cierre
    FROM
        tbl_cierre AS c
    WHERE
        c.id_parte = $id_parte";

    // Resultado
    return mysql_fetch_array(mysql_query($sql));
}

function emergencia($id_parte){
    // Consulta
    $sql =
    "SELECT
        e.h_ini_emer AS fec_con,
        e.calzada,
        e.tramo,
        e.via,
        e.abcisa
    FROM
        tbl_emergencias AS e
    WHERE
        e.id_parte = $id_parte";

    // Resultado
    return mysql_fetch_assoc(mysql_query($sql));
}

function incidente($id_parte){
    // Consulta
    $sql = 
    "SELECT
        i.h_ini_inc fec_con,
        i.calzada,
        i.tramo,
        i.via,
        i.abcisa,
        i.us_nombre,
        i.us_ced,
        i.us_ced,
        i.us_tel,
        i.us_tipo_veh,
        i.us_placa_veh,
        i.us_color_veh,
        i.us_marca_veh,
        i.us_serv_veh
    FROM
        tbl_incidente AS i
    WHERE
        i.id_parte = $id_parte";

    // Resultado
    return mysql_fetch_assoc(mysql_query($sql));
}

function incidente_incompleto($id_parte,$link){
    $consulta="Select * from tbl_incidente where id_parte = $id_parte";
    $result=  mysql_query($consulta,$link);
    $row = mysql_fetch_assoc($result);
    
    if($row["id_incidente"]=="" or	$row["id_parte"]=="" or	$row["via"]=="" or	$row["tramo"]=="" or	$row["calzada"]=="" or	$row["abcisa"]=="" or	$row["h_ini_inc"]=="" or	$row["h_fin_inc"]=="" or	$row["us_nombre"]=="" or	$row["us_ced"]=="" or	$row["us_tel"]=="" or	$row["us_placa_veh"]=="" or	$row["us_color_veh"]=="" or	$row["us_marca_veh"]=="" or	$row["us_serv_veh"]=="" or	$row["us_tipo_veh"]==""){
        return true;
    }
	
    if($row["tipo_inc"]==""){
        if($row["acc_trabajo"]=="" and	$row["per_muerta_via"]=="" and	$row["prim_aux"]=="" and	$row["veh_aban"]=="" and	$row["veh_inmov"]=="" and	$row["escom_via"]=="" and	$row["obs_via"]=="" and	$row["sem_muerto"]=="" and	$row["veh_varado"]=="" and	$row["otros"]==""){
            return true;
        }
    }
	
    if(victimas_incompletas($id_parte,$link)){
        return true;
    }
	
    return false;
}

function involucrados($id_parte){
    $sql =
    "SELECT
        *
    FROM
        tbl_involucrados AS i
    WHERE
        i.id_parte = $id_parte";

    return mysql_query($sql,Conectarse());
}

function involucrados_incompletos($id_parte,$link){
    $consulta="SELECT * FROM tbl_involucrados where id_parte=$id_parte";
    $result= mysql_query($consulta,$link);
    while($vect_ins = mysql_fetch_assoc($result)) {
        foreach($vect_ins as $key => $value):
            if($value==""){
                return true;
            }
        endforeach;
    }
    return false;
}

/**
 * Cuenta la cantidad de involucrados
 * * Reporte Matriz 
 * @param  [int] $id_parte [Consecutivo del parte]
 * @param  [string] $tipo_veh [Tipo de vehículo]
 * @return [int]           [Cantidad de involucrados]
 */
function involucrados_contar($id_parte, $tipo_veh = null){
    $condicion = "";
    $group = "";

    // Si trae tipo de vehículo
    if ($tipo_veh) {
        $condicion = "AND i.tipo_veh = '$tipo_veh'";
        $group = "GROUP BY i.tipo_veh";
    } // if

    $sql =
    "SELECT
        COUNT(i.tipo_veh) cantidad,
        i.tipo_veh
    FROM
        tbl_involucrados AS i
    WHERE
        i.id_parte = $id_parte
        $condicion
        $group";

    $resultado = mysql_fetch_assoc(mysql_query($sql,Conectarse()));

    if ($resultado["cantidad"]) {
        return $resultado["cantidad"];
    } else {
        return 0;
    }
}

function victimas_incompletas($id_parte,$link){
    $consulta="select * from tbl_victimas where id_parte=$id_parte";
    $result=mysql_query($consulta,$link);
    while($vect_ins = mysql_fetch_array($result)) {
        foreach($vect_ins as $key => $value):
            if($value==""){
                return true;
            }
        endforeach;
    }
    return false;
}

function otros($id_parte){
    // Consulta
    $sql = 
    "SELECT
            o.h_ini_otros AS fec_con,
            o.calzada,
            o.tramo,
            o.via,
            o.abcisa
        FROM
            tbl_otros AS o
        WHERE
            o.id_parte = $id_parte";

    // Resultado
    return mysql_fetch_assoc(mysql_query($sql));
}

function otros_incompleto($id_parte,$link){
    $consulta="Select * from tbl_otros where id_parte = $id_parte";
    $result=  mysql_query($consulta,$link);
    while($vect_ins = mysql_fetch_array($result)) {
        foreach($vect_ins as $key => $value):
            if($value==""){
                return true;
            }
        endforeach;
    }
    return false;
}

function procesar_foto($ruta, $directorio, $nombre){
    // return  "Ruta: ".$ruta."<br>Directorio: ".$directorio."<br>Nombre: ".$nombre;

    //Ruta de la imagen original
    $ruta_imagen = $ruta;

    //Creamos una variable imagen a partir de la imagen original
    $img_original = imagecreatefromjpeg($ruta_imagen);

    //Se define el maximo ancho y alto que tendra la imagen final
    $ancho_maximo = 640;
    $alto_maximo = 480;

    //Ancho y alto de la imagen original
    list($ancho, $alto) = getimagesize($ruta_imagen);

    //Se calcula ancho y alto de la imagen final
    $x_ratio = $ancho_maximo / $ancho;
    $y_ratio = $alto_maximo / $alto;

    /**
     * Si el ancho y el alto de la imagen no superan los maximos,
     * ancho final y alto final son los que tiene actualmente 
     */
    if( ($ancho <= $ancho_maximo) && ($alto <= $alto_maximo) ){
        //Si ancho
        $ancho_final = $ancho;
        $alto_final = $alto;
    } elseif (($x_ratio * $alto) < $alto_maximo){
        /*
        * si proporcion horizontal*alto mayor que el alto maximo,
        * alto final es alto por la proporcion horizontal
        * es decir, le quitamos al ancho, la misma proporcion que
        * le quitamos al alto
        *
        */
        $alto_final = ceil($x_ratio * $alto);
        $ancho_final = $ancho_maximo;
    }else{
        /*
        * Igual que antes pero a la inversa
        */
        $ancho_final = ceil($y_ratio * $ancho);
        $alto_final = $alto_maximo;
    }//Fin if  
    
    /**
     * Si el ancho y el alto de la imagen no superan los maximos,
     * ancho final y alto final son los que tiene actualmente
     */
    if( ($ancho <= $ancho_maximo) && ($alto <= $alto_maximo) ){
        //Si ancho
        $ancho_final = $ancho;
        $alto_final = $alto;
    }//Fin if

    /*
    * si proporcion horizontal*alto mayor que el alto maximo,
    * alto final es alto por la proporcion horizontal
    * es decir, le quitamos al ancho, la misma proporcion que
    * le quitamos al alto
    *
    */
    elseif (($x_ratio * $alto) < $alto_maximo){
        $alto_final = ceil($x_ratio * $alto);
        $ancho_final = $ancho_maximo;
    }else{
        /*
        * Igual que antes pero a la inversa
        */
        $ancho_final = ceil($y_ratio * $ancho);
        $alto_final = $alto_maximo;
    }  

    //Creamos una imagen en blanco de tamaño $ancho_final  por $alto_final .
    $imagen_temporal = imagecreatetruecolor($ancho_final,$alto_final);

    //Copiamos $img_original sobre la imagen que acabamos de crear en blanco ($imagen_temporal)
    imagecopyresampled($imagen_temporal, $img_original, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho, $alto);

    //Se destruye variable $img_original para liberar memoria
    imagedestroy($img_original);

    //Definimos la calidad de la imagen final
    $calidad = 95;

    //Se crea la imagen final en el directorio indicado
    if(imagejpeg($imagen_temporal, $directorio.$nombre, $calidad)){
        return true;
    } else {
        return false;
    }
}

function formatear_fecha($fecha){
    //Si No hay fecha, devuelva vac&iacute;o en vez de 0000-00-00
    if($fecha == '0000-00-00' || $fecha == '1969-12-31 19:00:00' || !$fecha){
        return false;
    }
    
    $dia_num = date("j", strtotime($fecha));
    $dia = date("N", strtotime($fecha));
    $mes = date("m", strtotime($fecha));
    $anio_es = date("Y", strtotime($fecha));

    //Nombres de los d&iacute;as
    if($dia == "1"){ $dia_es = "Lunes"; }
    if($dia == "2"){ $dia_es = "Martes"; }
    if($dia == "3"){ $dia_es = "Miercoles"; }
    if($dia == "4"){ $dia_es = "Jueves"; }
    if($dia == "5"){ $dia_es = "Viernes"; }
    if($dia == "6"){ $dia_es = "Sabado"; }
    if($dia == "7"){ $dia_es = "Domingo"; }

    //Nombres de los meses
    if($mes == "1"){ $mes_es = "enero"; }
    if($mes == "2"){ $mes_es = "febrero"; }
    if($mes == "3"){ $mes_es = "marzo"; }
    if($mes == "4"){ $mes_es = "abril"; }
    if($mes == "5"){ $mes_es = "mayo"; }
    if($mes == "6"){ $mes_es = "junio"; }
    if($mes == "7"){ $mes_es = "julio"; }
    if($mes == "8"){ $mes_es = "agosto"; }
    if($mes == "9"){ $mes_es = "septiembre"; }
    if($mes == "10"){ $mes_es = "octubre"; }
    if($mes == "11"){ $mes_es = "noviembre"; }
    if($mes == "12"){ $mes_es = "diciembre"; } 

    //a&ntilde;o
    //$anio_es = $anio_es;

    //Se foramtea la fecha
    $fecha = /*$dia_es." ".*/$dia_num." de ".$mes_es." de ".$anio_es;
    
    return $fecha;
}//Fin formato_fecha()
?>