<?php
$conn = mysql_connect("localhost","root" ,"");
mysql_select_db("catalogo", $conn);
$query = "SELECT * FROM categoria";
$resultado = mysql_query($query, $conn) or die(mysql_error());
while ($fila = mysql_fetch_assoc($resultado)) {
	echo "<option value=\"".$fila['categoria']."\">".$fila['categoria']."</option>";
}
?>