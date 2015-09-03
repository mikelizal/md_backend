
<?
include("vista.php");
include("modelo.php");
session_start();
$aux =mysql_connect('localhost','adminANzgeNV', 'N7hyyYbQkzqv');

if (!$aux){
	DIE(mysql_error());//para el php y muestra un error 
}else{

}

mysql_select_DB("meteor");
$a=null;
$b=null;
if(isset($_POST['username'])){
		$_SESSION['username']= $_POST["username"];
		$_SESSION["password"]= $_POST["password"];
		$a=$_SESSION['username'];
		

		$b = md5($_SESSION['password']);

		$si=0;

	}else{
		if(isset($_SESSION['username'])){
	
	 	$a=$_SESSION['username'];
	 	$b = md5($_SESSION['password']);	
	 	
		}else{
		
		}
}


	$dentro=0;
	
	
	
if($a !=null){

$quoro ='select * from administradores where username="'.$a.'" && password="'.$b.'" ';
$res = mysql_query($quoro);
$cont0=0;
$repetirlogin=1;
$dentro=0;
$fila = mysql_fetch_array($res);
while($fila != null){
$pass = $fila["password"];
$name = $fila["username"];
if(($b==$pass)&&($a==$name)){
$cont0=1;
$fila = mysql_fetch_array($res);
}else{
	
}
}
if ($cont0 !=0){ 
echo " soy el usuario ".$a ;


$dentro=1;
}else{
 
 $repetirlogin=1;
 
}
}else{
}

// una vez dentro//

if ($dentro==1){
	if(!isset($_REQUEST['accion'])){		
			 echo file_get_contents("plantillas/menucms.html");
	}else{
		$accion=$_REQUEST['accion'];
			if(isset($_REQUEST['id'])){
				$id=$_REQUEST['id'];
			
			}
			if($accion == "altaadmin"){
				switch($id){
					case 1:
						mValidarAltaAdmin();
					break;
					
				}
			}
			if($accion == "bymadmin"){
				switch ($id){
					case 1:
						vMostrarListadoAdmin(mDatosUnAdmin(),'bymadmin');
					break;
					case 2:
						vMostrarModificarEliminarAdmin(mListadoAdmin(),'modificaradmin');
					break;
					case 3:
						mValidarModificarAdmin(); 
						vMostrarListadoAdmin(mDatosUnAdmin(),'bymadmin');
					break;
					case 4:
						vMostrarModificarEliminarAdmin(mListadoAdmin(),'eliminaradmin');
					break;
					case 5:
						mValidarEliminarAdmin();
						vMostrarListadoAdmin(mDatosUnAdmin(),'bymadmin');
					break;
				}				
			}
			if($accion == "listadoadmin"){
				vMostrarListadoAdmin(mDatosUnAdmin(),'listadoadmin');
			}
			if($accion == "listadoobservacion"){
				switch ($id){
					case 1:
						vMostrarListadoObservacion(mDatosObservacion(),'listadoobservacion');
					break;
					case 2:
						vMostrarUnaObservacion(mDatosUnaObservacion());
					break;
					case 3:
						vMostrarUnaObservacion2(mDatosUnaObservacion2());
					break;
					case 4:
						vMostrarUnaObservacion3(mDatosUnaObservacion3());
					break;
					case 5:
						vMostrarGrafica(mMostrarGrafica());
					break;

						
				}
				
			}
			
			if($accion == "bymobservador"){
				switch ($id){
					case 1:
						vMostrarListadoObservador(mDatosObservador(),'bymlistadoobservador');
					break;
					case 2:
						vMostrarModificarEliminarObservador(mListadoObservador(),'modificarobservador');
					break;
					case 3:
						mValidarModificarObservador(); 
						vMostrarListadoObservador(mDatosObservador(),'bymlistadodobservador');
					break;
					
				}				
			}
			if($accion == "altatipoobservacion"){
				switch($id){
					case 1:
						vMostrarAltaTipoObservacion();
					break;
					case 2:
					
						vMostrarResultadoAltaTipoObservacion(mValidarAltaTipoObservacion());
					break;
				}
			}
			if($accion == "listadoobservador"){
				vMostrarListadoObservador(mDatosObservador(),'listadoobservador');
			}

			if($accion == "bymdispositivo"){
				switch ($id){
					case 1:
						vMostrarDispositivo(mDatosDispositivo(),'bymlistadodispositivo');
					break;
					case 2:
						vMostrarModificarEliminarDispositivo(mListadoDispositivo(),'modificardispositivo');
					break;
					case 3:
						mValidarModificarDispositivo(); 
						vMostrarDispositivo(mDatosDispositivo(),'bymlistadodispositivo');
					break;
					
				}	
			}
			if($accion == "listadodispositivo"){
				vMostrarDispositivo(mDatosDispositivo(),'listadodispositivo');
			}
			
	}
}else{
	//echo file_get_contents("meh.html");
	echo file_get_contents("plantillas/login.html");
}















?>
