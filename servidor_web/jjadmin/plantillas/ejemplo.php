<?
session_start();
$aux =mysql_connect('localhost','adminANzgeNV', 'N7hyyYbQkzqv');
echo "hola";
if (!$aux){
	DIE(mysql_error());//para el php y muestra un error 
}else{
echo "aqui entroo";
}
?>
