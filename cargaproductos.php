<ul>
<?php
$conn = mysql_connect("localhost","root" ,"");
mysql_select_db("catalogo", $conn);
$query = "SELECT * FROM categoria";
$resultado = mysql_query($query, $conn);;
if (!$resultado) {
    echo 'No se pudo ejecutar la consulta: ' . mysql_error();
    exit;
}
while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
	$query2 = "SELECT * FROM anuncio where categoria ='$fila[0]' order by prioridad desc";
	$resultado2 = mysql_query($query2, $conn);;
	if (!$resultado2) {
    		echo 'No se pudo ejecutar la consulta: ' . mysql_error();
    		exit;
	}
	while ($fila2 = mysql_fetch_array($resultado2, MYSQL_NUM)) {
		echo "<div class=\"tab-content\" style=\"display:block;\">";
		echo "<div class=\"items\">";
		echo "<div class=\"cl\">&nbsp;</div>";
		echo "<ul>";
		echo "<li>";
		echo "<div class=\"image\">";
	    	echo "<a href=\"#\"><img src=\"css/images/image1.jpg\" alt=\"\" /></a>";
		echo "</div>";
		echo "<p>";
		echo "ID Anuncio: <span>",$fila2[0],"</span><br />";
		echo "Nombre: <span>",$fila2[1],"</span><br />";
		echo "Descripcion: <a href=\"#\">",$fila2[2],"</a>";
		echo "</p>";
		echo "<p class=\"price\">Precio: <strong>Q",$fila2[3],"</strong></p>";
		echo "</li>";
		echo "</ul>";
		echo "<div class=\"cl\">&nbsp;</div>";
		echo "</div>";
		echo "</div>";
	}
mysql_free_result($resultado2);
}
mysql_free_result($resultado);
?>
</ul>