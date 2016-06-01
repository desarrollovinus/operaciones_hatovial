<?php
function Conectarse(){
	if (!($link=mysql_connect("databases",'operaciones','mymastersql'))){
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
?>