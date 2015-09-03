<?php
	include('modelo.php');
	include('vista.php');
	session_start();
	

	if(isset($_GET['action'])){
		$action = $_GET['action'];
		
		switch($action){
			
			case('info'):
				vmostrarinfo();
				break;
			
			
		}
		if(isset($_REQUEST['id'])){
				$id=$_REQUEST['id'];
			
		}

		if($action == "listadoobservacion"){
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
	} else {
		vmostrarindex(mmostrargraficas());
		//vmostrargraficas(mmostrargraficas());
	}
	
	function generarGrafica(){
	
	}
	
?>