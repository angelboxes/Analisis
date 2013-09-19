<?php
$mensaje=$_POST['mensaje'];
$id_usuario=$_POST['id_usuario'];
$id_vendedor=$_POST['id_vendedor'];
$id_anuncio=$_POST['id_anuncio'];
if($id_usuario!=$id_vendedor){
	$conn = mysql_connect("localhost","root" ,"");
	mysql_select_db("catalogo", $conn);
	$query = "SELECT * FROM usuario WHERE id_usuario=$id_vendedor UNION SELECT * FROM usuario WHERE id_usuario=$id_usuario;";
	$resultado = mysql_query($query, $conn);
	$fila = mysql_fetch_array($resultado, MYSQL_NUM);
	$vendedor=$fila;
	$fila = mysql_fetch_array($resultado, MYSQL_NUM);
	$usuario=$fila;
	
	ini_set("SMTP","mail.example.com");
	ini_set("smtp_port","25");
	ini_set('sendmail_from', 'example@YourDomain.com');
	mail("$vendedor[6]","Catalogo Virtual:$usuario[4],$usuario[3]","$mensaje \n De $usuario[4],$usuario[3]  <$usuario[6]>","From: catalogoVirtual@analisis.com");
	mysql_free_result($resultado);
}
$url="Location: index.php?id=$id_anuncio";
header($url);
?>