<?php
function mConexion(){ 
	$cnx = mysql_connect('localhost','adminANzgeNV', 'N7hyyYbQkzqv');
	return $cnx;
}


function mValidarAltaAdmin(){
		$suma='';

$html = file_get_contents('./plantillas/plantilla.html');
	$trozosHtml = explode('##cortar##', $html);

	$plantilla = file_get_contents("./plantillas/altaadmin.html");
	$aux = mConexion();
if (!$aux){
	DIE(mysql_error());//para el php y muestra un error 
}
if(isset($_POST['user'])){
	($user= $_POST['user']);
}else{
	$user='';
}

if(isset($_POST['nombre'])){
	($nombre= $_POST['nombre']);
}else{
	$nombre='';
}
if(isset($_POST['apellido'])){
	($apellido= $_POST['apellido']);
}else{
	$apellido='';
}


if(isset($_POST['mail'])){
	($mail= $_POST['mail']);
}else{
	$mail='';
}
if(isset($_POST['pass'])){
	($pass= $_POST['pass']);
}else{
	$pass='';
}
if(isset($_POST['pass2'])){
	($pass2= $_POST['pass2']);
}else{
	$pass2='';
}

if(isset($_POST['CANCEL'])){
	echo file_get_contents("./plantillas/menucms.html");
}else {
$inicio =0;
mysql_select_DB("meteor");

$comp = 'SELECT username FROM administradores ';
$ros = mysql_query($comp);
$fila=mysql_fetch_array($ros);
$j=0;
$i=0;
while($fila!=null){
if($user == $fila[$i]){
	$j++;
}
$fila=mysql_fetch_array($ros);
$i=0;
}

if($j<1){

if(($user!='') && ($mail!='') &&  ($pass!='') && ($pass2!='')&& ($apellido!='')&& ($nombre!='') ){


	$user = $_POST['user']; 
	$pass = $_POST['pass'];
	$md5pass = md5($pass); 
	$mail = $_POST['mail']; 
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$pass2 = $_POST['pass2']; 
	$admin = 1;
	$inicio=1;
	
 if($pass==$pass2){	
	
		$query = "insert into administradores(username,password,nombre,apellido,mail) values ('$user','$md5pass','$nombre','$apellido','$mail')";
		
	
	}
	$resultado = mysql_query($query);
	return $resultado;
	
 }else{
 
 	if($inicio != 0){
 		echo "las password deben ser iguales";
 		echo "\n";
 	}
 	
 			$persona = str_replace("##USERNAME##","$user",$plantilla);
 			$persona = str_replace("##NOMBRE##","$nombre",$persona); 
 			$persona = str_replace("##APELLIDO##","$apellido",$persona); 
			$persona = str_replace("##MAIL##","$mail",$persona); 				
			$suma.=$persona;
			echo $trozosHtml[0].$suma.$trozosHtml[2];
 }	

}else{
			echo "el login esta usado";
			
			$persona = str_replace("##USERNAME##","",$plantilla);
			$persona = str_replace("##NOMBRE##","",$plantilla);
			$persona = str_replace("##APELLIDO##","",$plantilla);
		
			$persona = str_replace("##MAIL##","$mail",$persona); 				
			$suma.=$persona;
			echo $trozosHtml[0].$suma.$trozosHtml[2];
}
}
}

function mListadoAdmin(){
	$cnx = mConexion();
	$id = $_GET["idadmin"];
	$query = 'select * from administradores where idadministrador = "'.$id.'" ';
	$datos = mysql_query($query);
	return $datos;
}
function mListadoObservador(){
	$cnx = mConexion();
	$id = $_GET["idobservador"];
	$query = 'select * from observador where idobservador  = "'.$id.'" ';
	$datos = mysql_query($query);
	return $datos;
}
function mListadoDispositivo(){
	$cnx = mConexion();
	$id = $_GET["iddispositivo"];
	$query = 'select * from tipodispositivo where idtipodispositivo  = "'.$id.'" ';
	$datos = mysql_query($query);
	return $datos;
}
function mDatosUnAdmin(){
	$cnx = mConexion();
	
	$query = "select * from administradores ";
	$resultado = mysql_query($query);
	return $resultado;
}
function mDatosUnaObservacion(){
	$cnx = mConexion();
	$id = $_GET["idobservador"];
	/*
	$query = 'select * from observacion where idobservador = "'.$id.'" ';
	$resultado = mysql_query($query);
	echo $id;
	*/
	return $id;
}
function mDatosUnaObservacion2(){
	$cnx = mConexion();
	
	$id = $_GET["idobservador"];
	$year = $_GET["year"];
	$query = 'select DISTINCT mes from observacion where idobservador = "'.$id.'" AND year = "'.$year.'" ';
	$resultado = mysql_query($query);
	
	
	return $resultado;
}

function mDatosUnaObservacion3(){
	$cnx = mConexion();
	
	$id = $_GET["idobservador"];
	$year = $_GET["year"];
	$mes = $_GET["mes"];
	$query = 'select detecciones from observacion where idobservador = "'.$id.'" AND year = "'.$year.'" AND mes = "'.$mes.'" ';
	$resultado = mysql_query($query);
	
	
	return $resultado;
}

function mMostrarGrafica(){
	$cnx = mconexion();
	mysql_select_DB("meteor");

	$idobservador = $_GET["idobservador"];
	$year = $_GET["year"];
	$mes = $_GET["mes"];

	$query = 'select  SUM(detecciones) as suma, dia from observacion where idobservador ='.$idobservador.'  AND mes ="'.$mes.'" AND year ="'.$year.'" group by (dia)';
	$resultado = mysql_query($query);




	return $resultado;
}



function mDatosObservacion(){
	$cnx = mConexion();
	
	$query = "select * from observador ";
	$resultado = mysql_query($query);
	return $resultado;
}

function mValidarModificarAdmin(){
	$cnx = mConexion();
	$id = $_POST["idadmin"];
	if(isset($_POST["password"])){
		$pass = $_POST["password"];
	}else{
		$pass = "";
	}

	echo $id;
	if($pass == ""){
	$query = 'update administradores set username="'.$_POST['name3'].'",nombre="'.$_POST['nombre'].'",apellido="'.$_POST['apellido'].'",mail="'.$_POST['mail'].'" where idadministrador="'.$id.'" ';
	}else{
		$passmd5 = md5($pass);
		$query = 'update administradores set username="'.$_POST['name3'].'",nombre ="'.$_POST['nombre'].'",apellido ="'.$_POST['apellido'].'",password ="'.$passmd5.'", mail="'.$_POST['mail'].'" where idadministrador="'.$id.'" ';
	}
	$resultado = mysql_query($query);
	
	return $resultado;
}
function mValidarEliminarAdmin(){
	$cnx = mConexion();
	$id = $_POST["idadmin"];
	
	$query = 'delete from administradores where idadministrador="'.$id.'" ';
	$resultado = mysql_query($query);
	return $resultado;
}
function mValidarModificarObservador(){
	$cnx = mConexion();
	$id = $_POST["idobservador"];
		
	$query = 'update observador set observador="'.$_POST['name3'].'"  where idobservador="'.$id.'" ';
	
	$resultado = mysql_query($query);
	
	return $resultado;
}
function mValidarModificarDispositivo(){
	$cnx = mConexion();
	$id = $_POST["iddispositivo"];
		
	$query = 'update tipodispositivo set dispositivo="'.$_POST['name3'].'"  where idtipodispositivo="'.$id.'" ';
	
	$resultado = mysql_query($query);
	
	return $resultado;
}

function mValidarEliminarDispositivo(){
	$cnx = mConexion();
	$id = $_POST["iddispositivo"];
	
	$query = 'delete from tipodispositivo where idtipodispositivo="'.$id.'" ';
	$resultado = mysql_query($query);
	return $resultado;
}
function mValidarEliminarTipoObservacion(){
	$cnx = mConexion();
	$id = $_POST["idtipoobservacion"];
	
	$query = 'delete from tiposobservacion where idtipoobservacion="'.$id.'" ';
	$resultado = mysql_query($query);
	return $resultado;
}

function mValidarAltaTipoObservacion(){

	if(isset($_POST['tipoobservacion'])){
	$tipoobservacion= $_POST['tipoobservacion'];
}else{
	$tipoobservacion='';
}

$cnx = mConexion();

if($tipoobservacion != ''){
	$query = "insert into tiposobservacion(nombreobservacion) values ('$tipoobservacion')";
	$resultado = mysql_query($query);
	
}
return $resultado;

}
function mDatosObservador(){
	$cnx = mConexion();
	
	$query = "select * from observador ";
	$resultado = mysql_query($query);
	return $resultado;

}
function mValidarAltaDispositivo(){
		if(isset($_POST['nombredispositivo'])){
	$nombredispositivo= $_POST['nombredispositivo'];
}else{
	$nombredispositivo='';
}
$cnx = mConexion();

if($nombredispositivo != ''){
	$query = "insert into tipodispositivo(dispositivo) values ('$nombredispositivo')";
	$resultado = mysql_query($query);
	
}
return $resultado;

}
function mDatosDispositivo(){
	$cnx = mConexion();
	
	$query = "select * from tipodispositivo ";
	$resultado = mysql_query($query);
	return $resultado;
}

?>
