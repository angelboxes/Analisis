<?php
function pruebaHistorialBusqueda(){
	$conn = mysql_connect("localhost","root" ,"");
	mysql_select_db("catalogo", $conn);
	$query = "SELECT * FROM busquedas";
	$resultado = mysql_query($query, $conn) or die(mysql_error());
	$totalBusquedas=0;
	while ($fila = mysql_fetch_assoc($resultado)){
		$totalBusquedas=$totalBusquedas+1;
	}
	return $totalBusquedas;
}


function ihistorialBusqueda($usuario,$busqueda,$conn){
	$fecha=date("Y-m-d H:i:s", time());
	$query = "INSERT INTO busquedas VALUES (NULL,$usuario,'$busqueda','$fecha')";
	return mysql_query($query, $conn);
}
?>