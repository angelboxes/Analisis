<?php
include 'mostrar.php';
include 'historial.php';
$conn = mysql_connect("localhost","root" ,"");
mysql_select_db("catalogo", $conn);
$usuario=3;
if($_GET){
$id_anuncio=$_GET['id'];
$id_vendedor=1;
echo "<center>Detalle del Anuncio<br />.<br />.<br />.<br />.<br />.<br />.</center>";

echo "<div style=\"width:940px;\" >";
echo "Contactar con vendedor<div style=\"min-height:1px; clear:both; width:100%; border-bottom:1px solid #d1d1d1; height:1px; padding-top:5px; margin-top:5px; margin-bottom:10px;\"></div>";						
echo "<form action=\"contacto.php\" method=\"POST\" enctype=\"multipart/form-data\">";
echo "<p><textarea name=\"mensaje\" rows=\"3\" style=\"width:100%;background:WhiteSmoke;border:0;color:BLACK\"></textarea></p><br />";
echo "<input type=\"hidden\" name=\"id_usuario\" value=\"$usuario\" />";
echo "<input type=\"hidden\" name=\"id_vendedor\" value=\"$id_vendedor\" />";
echo "<input type=\"hidden\" name=\"id_anuncio\" value=\"$id_anuncio\" />";
echo "<p><input type=\"submit\" style=\"width:100%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p>";
echo "</form></div>";
}else if($_POST){
	if($_POST['tipo']==1){
		$busqueda=$_POST['buscar'];
		$pagina=$_POST['pagina'];
		$index=($pagina-1)*8;
		historialBusqueda($usuario,$busqueda,$conn);
		$query = "SELECT * FROM anuncio WHERE producto like '%$busqueda%' or descripccion like '%$busqueda%' or categoria='$busqueda' ORDER BY prioridad desc LIMIT $index,8;";
		$resultado = mysql_query($query, $conn);
		$num=mostrarProducto($conn,$resultado);
		mysql_free_result($resultado);
		if($pagina>1||$num==8){
			echo "<ul>";
			if($pagina>1){
				$v=$pagina-1;
				echo "<li style=\"border:none\"><form action=\"index.php\" method=\"POST\">";
				echo "<input type=\"hidden\" name=\"tipo\" value=\"1\" />";
				echo "<input type=\"hidden\" name=\"buscar\" value=\"$busqueda\" />";
				echo "<input type=\"hidden\" name=\"pagina\" value=\"$v\" />";
				echo "<center><input type=\"submit\" value=\"<< Anterior\" style=\"width:100px;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></center>";
				echo "</form></li>";
			}else{echo "<li style=\"border:none\"> </li>";}
			echo "<li style=\"border:none\"> </li><li style=\"border:none\"> </li>";
			if($num==8){
				$v=$pagina+1;
				echo "<li style=\"border:none\"><form action=\"index.php\" method=\"POST\">";
				echo "<input type=\"hidden\" name=\"tipo\" value=\"1\" />";
				echo "<input type=\"hidden\" name=\"buscar\" value=\"$busqueda\" />";
				echo "<input type=\"hidden\" name=\"pagina\" value=\"$v\" />";
				echo "<center><input type=\"submit\" value=\"Siguiente >>\" style=\"width:100px;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></center>";
				echo "</form></li>";
			}else{echo "<li style=\"border:none\"> </li>";}
			echo "</ul><div class=\"cl\">&nbsp;</div>";
		}
	}
	if($_POST['tipo']==2){
		$busqueda=$_POST['categoria'];
		$pagina=$_POST['pagina'];
		$index=($pagina-1)*8;
		historialBusqueda($usuario,$busqueda,$conn);
		$query = "SELECT * FROM anuncio WHERE categoria='$busqueda' ORDER BY prioridad desc LIMIT $index,8;";
		$resultado = mysql_query($query, $conn);
		$num=mostrarProducto($conn,$resultado);
		mysql_free_result($resultado);
		if($pagina>1||$num==8){
			echo "<ul>";
			if($pagina>1){
				$v=$pagina-1;
				echo "<li style=\"border:none\"><form action=\"index.php\" method=\"POST\">";
				echo "<input type=\"hidden\" name=\"tipo\" value=\"2\" />";
				echo "<input type=\"hidden\" name=\"categoria\" value=\"$busqueda\" />";
				echo "<input type=\"hidden\" name=\"pagina\" value=\"$v\" />";
				echo "<center><input type=\"submit\" value=\"<< Anterior\" style=\"width:100px;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></center>";
				echo "</form></li>";
			}else{echo "<li style=\"border:none\"> </li>";}
			echo "<li style=\"border:none\"> </li><li style=\"border:none\"> </li>";
			if($num==8){
				$v=$pagina+1;
				echo "<li style=\"border:none\"><form action=\"index.php\" method=\"POST\">";
				echo "<input type=\"hidden\" name=\"tipo\" value=\"2\" />";
				echo "<input type=\"hidden\" name=\"categoria\" value=\"$busqueda\" />";
				echo "<input type=\"hidden\" name=\"pagina\" value=\"$v\" />";
				echo "<center><input type=\"submit\" value=\"Siguiente >>\" style=\"width:100px;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></center>";
				echo "</form></li>";
			}else{echo "<li style=\"border:none\"> </li>";}
			echo "</ul><div class=\"cl\">&nbsp;</div>";
		}
	}
	if($_POST['tipo']==3){
		$pagina=$_POST['pagina'];
		$index=($pagina-1)*8;
		$query = "SELECT * FROM anuncio ORDER BY prioridad desc LIMIT $index,8;";
		$resultado = mysql_query($query, $conn);
		$num=mostrarProducto($conn,$resultado);
		mysql_free_result($resultado);
		if($pagina>1||$num==8){
			echo "<ul>";
			if($pagina>1){
				$v=$pagina-1;
				echo "<li style=\"border:none\"><form action=\"index.php\" method=\"POST\">";
				echo "<input type=\"hidden\" name=\"tipo\" value=\"3\" />";
				echo "<input type=\"hidden\" name=\"pagina\" value=\"$v\" />";
				echo "<center><input type=\"submit\" value=\"<< Anterior\" style=\"width:100px;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></center>";
				echo "</form></li>";
			}else{echo "<li style=\"border:none\"> </li>";}
			echo "<li style=\"border:none\"> </li><li style=\"border:none\"> </li>";
			if($num==8){
				$v=$pagina+1;
				echo "<li style=\"border:none\"><form action=\"index.php\" method=\"POST\">";
				echo "<input type=\"hidden\" name=\"tipo\" value=\"3\" />";
				echo "<input type=\"hidden\" name=\"pagina\" value=\"$v\" />";
				echo "<center><input type=\"submit\" value=\"Siguiente >>\" style=\"width:100px;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></center>";
				echo "</form></li>";
			}else{echo "<li style=\"border:none\"> </li>";}
			echo "</ul><div class=\"cl\">&nbsp;</div>";
		}
	}
}else{
	$query = "SELECT * FROM anuncio ORDER BY prioridad desc LIMIT 0,8;";
	$resultado = mysql_query($query, $conn);
	$num=mostrarProducto($conn,$resultado);
	mysql_free_result($resultado);
	echo "<ul><li style=\"border:none\"> </li><li style=\"border:none\"> </li><li style=\"border:none\"> </li>";
	if($num==8){
		echo "<form action=\"index.php\" method=\"POST\">";
		echo "<input type=\"hidden\" name=\"tipo\" value=\"3\" />";
		echo "<input type=\"hidden\" name=\"pagina\" value=\"2\" />";
		echo "<center><input type=\"submit\" value=\"Siguiente >>\" style=\"width:100px;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></center>";
		echo "</form>";
	}else{echo "<li style=\"border:none\"> </li>";}
	echo "</ul><div class=\"cl\">&nbsp;</div>";
}
?>