<?php
function mostrarProducto($conn,$resultado){
	$num=0;
	while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
		$num=$num+1;
		echo "<li style=\"height:260px\">";
		echo "<div class=\"image\">";
		$query2 = "SELECT imagen FROM imagen WHERE id_anuncio=$fila[0];";
		$resultado2 = mysql_query($query2, $conn);;
		if($fila2 = mysql_fetch_array($resultado2, MYSQL_NUM)){
			echo "<a href=\"#\"><img style=\"width:190px;height:155px\" src=\"uploads/$fila2[0]\" alt=\"\" /></a>";
		}else{
			echo "<a href=\"#\">Imagen no disponible</a>";
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
	echo "</ul><div class=\"cl\">&nbsp;</div></div></div>";
	return $num;
}


$conn = mysql_connect("localhost","root" ,"");
mysql_select_db("catalogo", $conn);
if($_POST){
	if($_POST['tipo']==1){
		$busqueda=$_POST['buscar'];
		$query = "SELECT * FROM anuncio WHERE producto like '%$busqueda%' or descripccion like '%$busqueda%' ORDER BY prioridad desc;";
		$resultado = mysql_query($query, $conn);
		mostrarProducto($conn,$resultado);
		mysql_free_result($resultado);
	}
	if($_POST['tipo']==2){
		$busqueda=$_POST['categoria'];
		$query = "SELECT * FROM anuncio WHERE categoria='$busqueda' ORDER BY prioridad desc;";
		$resultado = mysql_query($query, $conn);
		mostrarProducto($conn,$resultado);
		mysql_free_result($resultado);
	}
	if($_POST['tipo']==3){
		$pagina=$_POST['pagina'];
		$l1=($pagina-1)*8;
		$query = "SELECT * FROM anuncio ORDER BY prioridad desc LIMIT $l1,8;";
		$resultado = mysql_query($query, $conn);
		$num=mostrarProducto($conn,$resultado);
		mysql_free_result($resultado);
			if($pagina>1){
				$v=$pagina-1;
				echo "<form action=\"index.php\" method=\"POST\">";
				echo "<input type=\"hidden\" name=\"tipo\" value=\"3\" />";
				echo "<input type=\"hidden\" name=\"pagina\" value=\"$v\" />";
				echo "<p><input type=\"submit\" value=\"<< Anterior\" style=\"width:100px;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p>";
				echo "</form>";
			}
			if($num==8){
				$v=$pagina+1;
				echo "<form action=\"index.php\" method=\"POST\">";
				echo "<input type=\"hidden\" name=\"tipo\" value=\"3\" />";
				echo "<input type=\"hidden\" name=\"pagina\" value=\"$v\" />";
				echo "<p><input type=\"submit\" value=\"Siguiente >>\" style=\"width:100px;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p>";
				echo "</form>";
			}
		}
	}else{
		$query = "SELECT * FROM anuncio ORDER BY prioridad desc LIMIT 0,8;";
		$resultado = mysql_query($query, $conn);
		$num=mostrarProducto($conn,$resultado);
		mysql_free_result($resultado);
		if($num==8){
			echo "<form action=\"index.php\" method=\"POST\">";
			echo "<input type=\"hidden\" name=\"tipo\" value=\"3\" />";
			echo "<input type=\"hidden\" name=\"pagina\" value=\"2\" />";
			echo "<p><input type=\"submit\" value=\"Siguiente >>\" style=\"width:100px;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p>";
			echo "</form>";
		}
	}
?>