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
	echo "<li><a href=\"#\" class=\"active\"><span>",$fila[0],"</span></a></li>";
}

mysql_free_result($resultado);
?>
</ul>