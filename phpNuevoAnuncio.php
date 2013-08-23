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
	$conn = mysql_connect("localhost","root" ,"");
	mysql_select_db("catalogo", $conn);
	$query = "INSERT INTO anuncio VALUES (NULL,'$d1','$d2',$d3,$d4,'$d5','$d6',$d7,$d8,'$d9',$d10)";
	mysql_query($query, $conn);
	$resultado = mysql_query("SELECT MAX(id_anuncio) AS id FROM anuncio");
	if ($row = mysql_fetch_row($resultado)) {
		$id = trim($row[0]);
		if($_FILES['imagen1']['size']>0){
			if($_FILES['imagen1']['type']=="image/jpeg"){
				$nom=date("Ymdhis").$_FILES['imagen1']['name'];
				move_uploaded_file ($_FILES['imagen1']['tmp_name'], "uploads\\".$nom);
				mysql_query("INSERT INTO imagen VALUES (NULL,'$nom','$id')");
			}
		}if($_FILES['imagen2']['size']>0){
			if($_FILES['imagen2']['type']=="image/jpeg"){
				$nom=date("Ymdhis").$_FILES['imagen2']['name'];
				move_uploaded_file ($_FILES['imagen2']['tmp_name'], "uploads\\".$nom);
				mysql_query("INSERT INTO imagen VALUES (NULL,'$nom','$id')");
			}
		}if($_FILES['imagen3']['size']>0){
			if($_FILES['imagen3']['type']=="image/jpeg"){
				$nom=date("Ymdhis").$_FILES['imagen3']['name'];
				move_uploaded_file ($_FILES['imagen3']['tmp_name'], "uploads\\".$nom);
				mysql_query("INSERT INTO imagen VALUES (NULL,'$nom','$id')");
			}
		}
	}
	header('Location: index.php');
?>