<?php
	$d1=$_POST['producto'];
	$d2=$_POST['descripccion'];
	$d3=$_POST['precio'];
	$d4=$_POST['cantidad'];
	$d5=$_POST['condicion'];
	$d6=$_POST['fecha'];
	$d7=1;
	$d8=$_POST['prioridad'];
	$d9=$_POST['categoria'];
	$d10=1;
	echo $d1."<br />";
	echo $d2."<br />";
	echo $d3."<br />";
	echo $d4."<br />";
	echo $d5."<br />";
	echo $d6."<br />";
	echo $d7."<br />";
	echo $d8."<br />";
	echo $d9."<br />";
	echo $d10."<br />";
	$conn = mysql_connect("localhost","root" ,"");
	mysql_select_db("catalogo", $conn);
	$query = "INSERT INTO anuncio VALUES (NULL,'$d1','$d2',$d3,$d4,'$d5','$d6',$d7,$d8,'$d9',$d10)";
	echo "<br /><br />".$query."<br /><br />";
	$resultado = mysql_query($query, $conn) or die(mysql_error());
?>