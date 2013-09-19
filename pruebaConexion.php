<?php
function Conexion(){
	$conn = mysql_connect("localhost","root" ,"");
	return ($conn);
}

function ConexionBD($name){
	$conn = mysql_connect("localhost","root" ,"");
	mysql_select_db($name, $conn);
	return ($conn);
}

?>