<?php
	
	function vmostrarindex($resultado){
		$html = file_get_contents('templates/index.html');

		$html = vmostrargraficas($html, $resultado);
		echo $html;
		
		
	}
	function vmostrargraficas($html, $resultado){


		$ad = mysql_fetch_array($resultado);
		$contenido = $html;

		while($ad != null){
			$contenido = str_replace("##".$ad['dia']."##", $ad['suma'], $contenido);
			$ad = mysql_fetch_array($resultado);
		}
		return $contenido;

	}
	
	function vmostrarcontacto(){
		$html = file_get_contents('templates/contacto.html');
		echo $html;
		
	}
	
	function vmostrarinfo(){
		$html = file_get_contents('templates/informacion.html');
		echo $html;	
	}
	
	function vmostrardispositivos(){
		$html = file_get_contents('templates/dispositivos.html');
		echo $html;	
	}

	function vMostrarListadoObservacion($obs,$opciones){
	$html = file_get_contents('./plantillas/plantilla.html');
	$trozosHtml = explode('##cortar##', $html);
	if ( $opciones == 'bymobservaciones') {
		$plantilla=file_get_contents('./plantillas/listadobymobservaciones.html');
	}else{
		$plantilla=file_get_contents('./plantillas/listadoobservaciones.html');
	}
	
	$trozos = explode ('##fila##', $plantilla);
	$contenido = '';
	$contenido.=$trozos[0];
	if($obs>0){
	$administrador = mysql_fetch_array($obs);
	}

	while ($administrador != null){
	
		$aux=$trozos[1];
		$aux=str_replace('##OBSERVADOR##',$administrador['observador'],$aux);
		
		$aux=str_replace('##idobservador##',$administrador['idobservador'],$aux);
	
		$contenido.=$aux;
		$administrador = mysql_fetch_array($obs);
	}

	$contenido.=$trozos[2];

	echo $trozosHtml[0].$contenido.$trozosHtml[2];
}
function vMostrarUnaObservacion($resultado){
	$html = file_get_contents('./plantillas/plantilla.html');
	$trozosHtml = explode('##cortar##', $html);
	$plantilla=file_get_contents('./plantillas/listadoyears.html');
	$trozos = explode ('##fila##', $plantilla);
	$contenido = '';
	$contenido.=$trozos[0];
	
	$idobs = $resultado;
	$cnx = mysql_connect('localhost','adminANzgeNV', 'N7hyyYbQkzqv');
	mysql_select_DB("meteor");
	

	$query = 'select DISTINCT year from observacion where  idobservador = "'.$idobs.'" ';
		$datos0 = mysql_query($query);
		$datos =mysql_fetch_array($datos0);

	$query2 = 'select * from observador where  idobservador = "'.$idobs.'" ';
		$datos1 = mysql_query($query2);
		$datos3 =mysql_fetch_array($datos1);	
		


		$contenido=str_replace('##OBSERVADOR##',$datos3['observador'],$contenido);
	while ($datos != null){
		$aux=$trozos[1];
		
		$aux=str_replace('##YEAR##',$datos['year'],$aux);
		$aux=str_replace('##idobservador##',$idobs,$aux);
		$aux=str_replace('##year##',$datos['year'],$aux);
	
	
		$contenido.=$aux;
		$datos = mysql_fetch_array($datos0);
	}

	$contenido.=$trozos[2];

	echo $trozosHtml[0].$contenido.$trozosHtml[2];

}

function vMostrarUnaObservacion2($resultado){
	$html = file_get_contents('./plantillas/plantilla.html');
	$trozosHtml = explode('##cortar##', $html);
	$plantilla=file_get_contents('./plantillas/listadomeses.html');
	$trozos = explode ('##fila##', $plantilla);
	$contenido = '';
	$contenido.=$trozos[0];

	$year = $_GET["year"];
	
	$idobs = $_GET["idobservador"];

	
	if($resultado>0){
	$administrador = mysql_fetch_array($resultado);
	}else{
		$administrador=null;
	}
	
	
	$cnx = mysql_connect('localhost','adminANzgeNV', 'N7hyyYbQkzqv');
	mysql_select_DB("meteor");
	


	$query2 = 'select * from observador where  idobservador = "'.$idobs.'" ';
		$datos1 = mysql_query($query2);
		$datos3 =mysql_fetch_array($datos1);	
		


		$contenido=str_replace('##OBSERVADOR##',$datos3['observador'],$contenido);
		$contenido=str_replace('##YEAR##',$year,$contenido);
	while ($administrador != null){
		$aux=$trozos[1];
		
		$aux=str_replace('##YEAR##',$year,$aux);
		$aux=str_replace('##idobservador##',$idobs,$aux);
		$aux=str_replace('##year##',$year,$aux);
		$aux=str_replace('##MES##',$administrador['mes'],$aux);
		$aux=str_replace('##mes##',$administrador['mes'],$aux);
	
	
		$contenido.=$aux;
		$administrador = mysql_fetch_array($resultado);
	}

	$contenido.=$trozos[2];

	echo $trozosHtml[0].$contenido.$trozosHtml[2];

}
function vMostrarUnaObservacion3($resultado){
	$html = file_get_contents('./plantillas/plantilla.html');
	$trozosHtml = explode('##cortar##', $html);
	$plantilla=file_get_contents('./plantillas/listadodatos.html');
	$trozos = explode ('##fila##', $plantilla);
	$filaGlobal = $trozos[1];
	$colGlobal = explode('##columna##', $filaGlobal);
	$contenido ='';
	$contenido = $trozos[0];
	$fin ='';
	$fin = $trozos[2];
	$fila ='';
	


	$year = $_GET["year"];
	$idobs = $_GET["idobservador"];
	$mes = $_GET["mes"];

	

	
	if($resultado>0){
	$administrador = mysql_fetch_array($resultado);
	}else{
		$administrador=null;
	}
	
	
	$cnx = mysql_connect('localhost','adminANzgeNV', 'N7hyyYbQkzqv');
	mysql_select_DB("meteor");
	


	$query2 = 'select observador from observador where  idobservador = "'.$idobs.'" ';
		$datos1 = mysql_query($query2);
		$datos3 =mysql_fetch_array($datos1);

		$fin=str_replace('##idobservador##',$idobs,$fin);
		$fin=str_replace('##year##',$year,$fin);
		$fin=str_replace('##mes##',$mes,$fin);


		$contenido=str_replace('##OBSERVADOR##',$datos3['observador'],$contenido);
		$contenido=str_replace('##YEAR##',$year,$contenido);
		$contenido=str_replace('##MES##',$mes,$contenido);
		$cont=1;
	while($administrador != null){
		$fila = $colGlobal[0];
		$fila = str_replace("<tr>", "", $fila);
		$fila = str_replace("##DIA##",$cont,$fila);
		
		for($i =0; $i<24; $i++){
			$aux= $colGlobal[1];
			$aux = str_replace("##DET##", $administrador['detecciones'], $aux);
			$fila.= $aux;
			$administrador = mysql_fetch_array($resultado);
		}
		$fila .= $colGlobal[2];
		$contenido .= $fila;
		$cont++;



	}	
		$contenido.= $fin;
		echo $trozosHtml[0].$contenido.$trozosHtml[2];
}

function vMostrarGrafica($resultado){

		$year = $_GET["year"];	
		$mes = $_GET["mes"];

		$html = file_get_contents('./plantillas/plantilla.html');
		$trozosHtml = explode('##cortar##', $html);
		$plantilla=file_get_contents('./plantillas/grafica.html');


		$ad = mysql_fetch_array($resultado);
		$contenido = $plantilla;

		while($ad != null){
			$contenido = str_replace("##".$ad['dia']."##", $ad['suma'], $contenido);
			$ad = mysql_fetch_array($resultado);
		}
		$contenido = str_replace("##mes##",$mes,$contenido);
		$contenido = str_replace("##year##",$year,$contenido);
		echo $trozosHtml[0].$contenido.$trozosHtml[2];

	}


?>