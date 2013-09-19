<?php
function mostrarProducto($conn,$resultado){
	$num=0;
	echo "<div class=\"cl\">&nbsp;</div><ul>";
	while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
		$num=$num+1;
		echo "<li style=\"height:260px\">";
		echo "<div class=\"image\">";
		$query2 = "SELECT imagen FROM imagen WHERE id_anuncio=$fila[0];";
		$resultado2 = mysql_query($query2, $conn);
		if($fila2 = mysql_fetch_array($resultado2, MYSQL_NUM)){
			echo "<a href=\"index.php?id=$fila[0]\"><img style=\"width:190px;height:155px\" src=\"uploads/$fila2[0]\" alt=\"\" /></a>";
		}else{
			echo "<a href=\"index.php?id=$fila[0]\">Imagen no disponible</a>";
		}
		echo "</div>";
		echo "<p>";
		echo "<br />";
		echo "Nombre: <span>",$fila[1],"</span><br />";
		echo "Descripcion: <a href=\"#\">",$fila[2],"</a>";
		echo "</p>";
		echo "<p class=\"price\">Precio: <strong>Q",$fila[3],"</strong></p>";
		echo "</li>";
	}
	echo "</ul><div class=\"cl\">&nbsp;</div>";
	return $num;
}
?>