<?php

function mconexion(){ 
	$cnx = mysql_connect('localhost','adminANzgeNV', 'N7hyyYbQkzqv');
	mysql_select_DB("meteor");
	return $cnx;
}

function mmostrargraficas(){
	$cnx = mconexion();
	mysql_select_DB("meteor");

	$query = 'select MAX(idobservacion) as id from observacion';


	$resultado = mysql_query($query) or die(mysql_error());
	$id = mysql_fetch_array($resultado);

	$query = 'select * from observacion where idobservacion = '.$id['id'].' '; 
	$resultado = mysql_query($query);
	$aux = mysql_fetch_array($resultado);
	$idobservador = $aux['idobservador'];
	$mes = $aux['mes'];
	$year = $aux['year'];
	
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

function mDatosUnaObservacion(){
	$cnx = mConexion();
	$id = $_GET["idobservador"];	
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

	
?>