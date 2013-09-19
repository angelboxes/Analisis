<?php
$conn = mysql_connect("localhost","root" ,"");
mysql_select_db("catalogo", $conn);
$usuario=1;
if($usuario!=0){
	$query = "SELECT busqueda, count(*) as cantidad, max(fecha) as fecha FROM busquedas WHERE id_usuario=$usuario GROUP BY busqueda ORDER BY cantidad desc, fecha LIMIT 0,5;";
	$resultado = mysql_query($query, $conn);
	echo "<ul>";
	while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
		echo "<li style=\"width:auto\"><form action=\"index.php\" method=\"POST\">";
		echo "<input type=\"hidden\" name=\"tipo\" value=\"1\" />";
		echo "<input type=\"hidden\" name=\"buscar\" value=\"$fila[0]\" />";
		echo "<input type=\"hidden\" name=\"pagina\" value=\"1\" />";
		echo "<center><input type=\"submit\" value=\"$fila[0]\" style=\"height:25px;background:White;border:0;color:BLACK\" /></center>";
		echo "</form></li>";
	}
	echo "</ul><div class=\"cl\">&nbsp;</div>";
	mysql_free_result($resultado);
}else{
	$query = "SELECT categoria, count(*) as cantidad FROM anuncio GROUP BY categoria ORDER BY cantidad desc LIMIT 0,5;";
	$resultado = mysql_query($query, $conn);
	echo "<ul>";
	while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
		echo "<li style=\"width:auto\"><form action=\"index.php\" method=\"POST\">";
		echo "<input type=\"hidden\" name=\"tipo\" value=\"2\" />";
		echo "<input type=\"hidden\" name=\"categoria\" value=\"$fila[0]\" />";
		echo "<input type=\"hidden\" name=\"pagina\" value=\"1\" />";
		echo "<input type=\"submit\" value=\"$fila[0]\" style=\"height:25px;background:White;border:0;color:BLACK\" />";
		echo "</form></li>";
	}
	echo "</ul><div class=\"cl\">&nbsp;</div>";
	mysql_free_result($resultado);
}
?>