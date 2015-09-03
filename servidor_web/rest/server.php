<?

$method = $_SERVER['REQUEST_METHOD'];

 

$resource = $_SERVER['REQUEST_URI'];

echo "metodo ".$method."  -> ";
if($method=="POST"){
	$var =$_POST["json"];
	$dec = json_decode($var);
		$clave =$dec->clave;
    if($clave =="ab5639kgaht54kjgahtrlbfgmadgf"){
        $antena = $dec->antena;
        $mes =$dec->mes;
        $observador = $dec->observador;
        $year= $dec->year;


       
        $datos =$dec->datos ;
       $datosArr = preg_split("/[\s,]+/", $datos);
      
       
       $aux =mysqli_connect('localhost','adminANzgeNV', 'N7hyyYbQkzqv','meteor');

if (!$aux){
	DIE(mysqli_error());//para el php y muestra un error 
}else{


    //PRUEBA
    $a = 'select * from observador where  observador  ="'.$observador.'"';
    $rep = $aux ->query($a);
    $rep1 = mysqli_num_rows($rep);
    //PRUEBA
     $b = 'select * from tipodispositivo where  dispositivo  ="'.$antena.'"';
    $rep2 = $aux ->query($b);
    $rep3 = mysqli_num_rows($rep2);


    if($rep1 ==0){
      $queryaux = "insert into observador(observador) values ('$observador')";
      $quoro = $aux ->query($queryaux);
      $idobservador= $aux ->insert_id;
     }else{
      $row = $rep->fetch_array(MYSQLI_ASSOC);
      $idobservador = $row['idobservador'];
     }
 
     if($rep3 ==0){
    $queryaux2 = "insert into tipodispositivo(dispositivo) values ('$antena')";
    $quoro2 = $aux ->query($queryaux2);
    $idtipodispositivo = $aux ->insert_id;
    }else{
      $row2 = $rep2->fetch_array(MYSQLI_ASSOC);
      $idtipodispositivo = $row2['idtipodispositivo'];
    }



  $cont=1;
  for($i=0;$i <count($datosArr)-1;$i++){

	 $d = $datosArr[$i];
    if($d == "???"){
      $d="0";
    }
    if($d == "||"){

      $cont= $cont+1;
    }
    if($d != "||"){

    $query = "insert into observacion(idobservador,idtipodispositivo,mes,dia,detecciones,year) values ('$idobservador','$idtipodispositivo','$mes','$cont','$d','$year')";
    $resultado = $aux ->query($query);

		
		echo $resultado;
  }
  }

		
}       	
       }else{
       
       	DIE("m");
       }
  
         
         
         
   
   
	}

$aux->close();


?>