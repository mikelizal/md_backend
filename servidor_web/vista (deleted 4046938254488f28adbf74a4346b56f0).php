<?php
	
	function vmostrarindex(){
		$html = file_get_contents('templates/index.html');
		echo $html;
		
		/* Código del login del index
		<form class="navbar-form navbar-right" action="index.php?action=login" method="POST">
            <div class="form-group">
              <input placeholder="Username" class="form-control" type="text">
            </div>
            <div class="form-group">
              <input placeholder="Password" class="form-control" type="password">
            </div>
            <button type="submit" class="btn btn-success">Login</button>
          </form>
		  */
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
?>