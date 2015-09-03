<?php
function vMostrarLogin(){
	echo file_get_contents("./plantillas/login.html");
}
function vMostrarMenuCms(){
	echo file_get_contents('./plantillas/menucms.html');
}
/*function vMostrarAltaAdmin(){
	echo file_get_contents('./plantillas/altaadmin.html');
}
*/

function vMostrarListadoAdmin($user,$opciones){
	$html = file_get_contents('./plantillas/plantilla.html');
	$trozosHtml = explode('##cortar##', $html);
	if ( $opciones == 'bymadmin') {
		$plantilla=file_get_contents('./plantillas/listadobymadmin.html');
	}else{
		$plantilla=file_get_contents('./plantillas/listadoadmin.html');
	}
	
	$trozos = explode ('##fila##', $plantilla);
	$contenido = '';
	$contenido.=$trozos[0];
	$resultado = mDatosUnAdmin();
	$administrador = mysql_fetch_array($resultado);
	
	while ($administrador != null){
		$aux=$trozos[1];
		$aux=str_replace('##administrador##',$administrador['username'],$aux);
		$aux=str_replace('##nombre##',$administrador['nombre'],$aux);
		$aux=str_replace('##apellido##',$administrador['apellido'],$aux);
		$aux=str_replace('##mail##',$administrador['mail'],$aux);
		$aux=str_replace('##idadmin##',$administrador['idadministrador'],$aux);
		
		
		$contenido.=$aux;
		$administrador = mysql_fetch_array($resultado);
	}

	$contenido.=$trozos[2];

	//echo $contenido;
	echo $trozosHtml[0].$contenido.$trozosHtml[2];
}
function vMostrarModificarEliminarAdmin($datos,$opciones){
	$html = file_get_contents('./plantillas/plantilla.html');
	$trozosHtml = explode('##cortar##', $html);

	if($opciones == 'modificaradmin'){
		$plantilla = file_get_contents('./plantillas/modificaradmin.html');
	}else{
		$plantilla = file_get_contents('./plantillas/eliminaradmin.html');
	
	}
	$administrador=mysql_fetch_array($datos);
	$plantilla = str_replace('##name##',$administrador['username'],$plantilla);
	$plantilla = str_replace('##nombre##',$administrador['nombre'],$plantilla);
	$plantilla = str_replace('##apellido##',$administrador['apellido'],$plantilla);
	$plantilla = str_replace('##mail##',$administrador['mail'],$plantilla);
	$plantilla = str_replace('##idadmin##',$administrador['idadministrador'],$plantilla);
	
	
		
	echo $trozosHtml[0].$plantilla.$trozosHtml[2];
	
}
function vMostrarResultadoValidarModificarAdmin($resultado){
	if($resultado){
		echo "Se ha modificado el administrador";
		echo '<a href="./index.php">Volver</a>';
	}else{
		echo "No se ha podido modificar el administrador";
		echo '<a href="./index.php">Volver</a>';
	}
	$html = file_get_contents('./plantillas/menucms.html');
	echo $html;
}
function vMostrarResultadoValidarEliminarAdmin($resultado){
	if($resultado){
		echo "Se ha eliminado el administrador";
		echo '<a href="./index.php">Volver</a>';
	}else{
		echo "No se ha podido eliminar el administrador";
		echo '<a href="./index.php">Volver</a>';
	}
	$html = file_get_contents('./plantillas/menucms.html');
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


function vMostrarModificarEliminarObservador($datos,$opciones){
	$html = file_get_contents('./plantillas/plantilla.html');
	$trozosHtml = explode('##cortar##', $html);
	if($opciones == 'modificarobservador'){
		$plantilla = file_get_contents('./plantillas/modificarobservador.html');
	}
	$administrador=mysql_fetch_array($datos);
	$plantilla = str_replace('##observador##',$administrador['observador'],$plantilla);
	$plantilla = str_replace('##idobservador##',$administrador['idobservador'],$plantilla);
		
	echo $trozosHtml[0].$plantilla.$trozosHtml[2];
	
}
function vMostrarModificarEliminarDispositivo($datos,$opciones){

	$html = file_get_contents('./plantillas/plantilla.html');
	$trozosHtml = explode('##cortar##', $html);

	if($opciones == 'modificardispositivo'){
		$plantilla = file_get_contents('./plantillas/modificardispositivo.html');
	}
	$administrador=mysql_fetch_array($datos);
	$plantilla = str_replace('##name##',$administrador['dispositivo'],$plantilla);
	$plantilla = str_replace('##iddispositivo##',$administrador['idtipodispositivo'],$plantilla);
		
	echo $trozosHtml[0].$plantilla.$trozosHtml[2]; 
	
}










function vMostrarAltaTipoObservacion(){
	$contenido =file_get_contents('./plantillas/altatipoobservacion.html');

	$html = file_get_contents('./plantillas/plantilla.html');
	$trozosHtml = explode('##cortar##', $html);

	echo $trozosHtml[0].$contenido.$trozosHtml[2];

}



function vMostrarListadoObservador($obs,$opciones){
	$html = file_get_contents('./plantillas/plantilla.html');
	$trozosHtml = explode('##cortar##', $html);

	if ( $opciones == 'bymlistadoobservador') {
		$plantilla=file_get_contents('./plantillas/listadobymobservador.html');
	}else{
		$plantilla=file_get_contents('./plantillas/listadoobservadores.html');
	}
	
	$trozos = explode ('##fila##', $plantilla);
	$contenido = '';
	$contenido.=$trozos[0];
	if($obs>0){
	$administrador = mysql_fetch_array($obs);
	}
	
	while ($administrador != null){
		$aux=$trozos[1];
		$aux=str_replace('##observador##',$administrador['observador'],$aux);
		$aux=str_replace('##idobservador##',$administrador['idobservador'],$aux);
	
	
		$contenido.=$aux;
		$administrador = mysql_fetch_array($obs);
	}

	$contenido.=$trozos[2];

	echo $trozosHtml[0].$contenido.$trozosHtml[2];
}
function vMostrarAltaDispositivo(){
	echo file_get_contents('./plantillas/altadispositivo.html');
}


function vMostrarResultadoAltaDispositivo($resultado){
	if($resultado){
		echo "Se ha creado el dispositivo";
		echo '<a href="./index.php">Volver</a>';
	}else{
		echo "No se ha podido crear el dispositivo";
		echo '<a href="./index.php">Volver</a>';
	}
	$html = file_get_contents('./plantillas/menucms.html');
	echo $html;

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




function vMostrarDispositivo($obs,$opciones){
	$html = file_get_contents('./plantillas/plantilla.html');
	$trozosHtml = explode('##cortar##', $html);

	
	if ( $opciones == 'bymlistadodispositivo') {
		
		$plantilla=file_get_contents('./plantillas/listadobymdispositivos.html');
	}else{
		
		$plantilla=file_get_contents('./plantillas/listadodispositivos.html');
	}
	
	$trozos = explode ('##fila##', $plantilla);
	$contenido = '';
	$contenido.=$trozos[0];
	if($obs>0){
	$administrador = mysql_fetch_array($obs);
	}else{
		$administrador=null;
	}
	
	while ($administrador != null){
		$aux=$trozos[1];
		$aux=str_replace('##dispositivo##',$administrador['dispositivo'],$aux);
		$aux=str_replace('##iddispositivo##',$administrador['idtipodispositivo'],$aux);
	
	
		$contenido.=$aux;
		$administrador = mysql_fetch_array($obs);
	}

	$contenido.=$trozos[2];

	echo $trozosHtml[0].$contenido.$trozosHtml[2];
}














?>
