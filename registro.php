<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php session_start(); 
	if($_SESSION){header("Location: index.php");}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Pagina Web</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />	
	<script src="js/jquery-1.4.1.min.js" type="text/javascript"></script>
	<script src="js/jquery.jcarousel.pack.js" type="text/javascript"></script>
	<script src="js/jquery.slide.js" type="text/javascript"></script>
	<script src="js/jquery-func.js" type="text/javascript"></script>
</head>
<body>
<!-- Top -->
<div id="top">
	
	<div class="shell">
		
		<!-- Header -->
		<div id="header">
			<div id="navigation">
				<ul>
				    <li><a href="index.php">Inicio</a></li>
					<li><a href="registro.php">Registro</a></li>
					<li class="last"><a href="login.php">Login</a></li>
				</ul>
			</div>
		</div>
		<!-- End Header -->
		
		
		<div id="slider">
			<div id="slider-holder">
				<ul>
				<!--
				    <li><a href="#"><img src="css/images/slide1.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/slide2.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/slide1.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/slide2.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/slide1.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/slide2.jpg" alt="" /></a></li>
				-->
				</ul>
			</div>
			<div id="slider-nav">
				<a href="#" class="prev">Previous</a>
				<a href="#" class="next">Next</a>
			</div>
		</div>
		
	</div>
</div>
<!-- Top -->

<!-- Main -->
<div id="main">
	<div class="shell">
		
		<!--Busqueda-->
		<div class="options">
			<div class="search">
				<form action="index.php" method="POST">
					<span class="field"><input type="text" class="blink" value="Busqueda Avanzada" name="buscar" /></span>
					<input type="hidden" name="tipo" value="1" />
					<input type="hidden" name="pagina" value="1" />
					<input type="submit" class="search-submit" value="GO" />
				</form>
			</div>
			<div class="search">
				<form action="index.php" method="POST">
					<span class="field"><select name="categoria">
						<?php include 'categoria.php'; ?>
						</select></span>
						<input type="hidden" name="tipo" value="2" />
						<input type="hidden" name="pagina" value="1" />
					<input type="submit" class="search-submit" value="GO" />
				</form>
			</div>
		</div>
		<!--Busqueda-->
		
		<!-- Content -->
		<div id="content">
			
			<!-- Tabs -->
			<div class="tabs"><ul>
				    <li><a href="#" class="active"><span>Registro</span></a></li>
			</ul></div>
			<!-- Tabs -->
			
			<!-- Container -->
			<div id="container">
				<div class="tabbed">
					<!-- Tab Registro -->
					<div class="tab-content" style="display:block;">
						<div>
<?php
if($_GET){
	$usuario=$_GET['usuario'];
	$nombre=$_GET['nombre'];
	$apellido=$_GET['apellido'];
	$direccion=$_GET['direccion'];
	$correo=$_GET['correo'];
	$error=$_GET['error'];
	echo "<form action=\"registro.php\" method=\"POST\">
		<div style=\"float:left;width:50%;\">
			<p>Usuario</p><p><input type=\"text\" name=\"usuario\" value=\"$usuario\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p><br />
			<p>Nombre(s)</p><p><input type=\"text\" name=\"nombre\" value=\"$nombre\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p><br />
			<p>Apellido(s)</p><p><input type=\"text\" name=\"apellido\" value=\"$apellido\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p><br />
			<p>Direccion</p><p><input type=\"text\" name=\"direccion\" value=\"$direccion\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p><br />
			<p>$error</p>
		</div>
		<div style=\"float:left;width:50%;\">
			<p>Contrase&ntildea </p><p><input type=\"password\" name=\"clave1\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p><br />
			<p>Repetir Contrase&ntildea </p><p><input type=\"password\" name=\"clave2\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p><br />
			<p>Correo</p><p><input type=\"email\" name=\"correo\" value=\"$correo\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p><br />
			<br /><p><input type=\"submit\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p>
		</div>
	</form>";
}else if($_POST){
	$usuario=$_POST['usuario'];
	$nombre=$_POST['nombre'];
	$apellido=$_POST['apellido'];
	$direccion=$_POST['direccion'];
	$clave1=$_POST['clave1'];
	$clave2=$_POST['clave2'];
	$correo=$_POST['correo'];
	$conn = mysql_connect("localhost","root" ,"");
	mysql_select_db("catalogo", $conn);
	$valido=true;
	$error="";
	$query = "SELECT username FROM usuario WHERE username like '$usuario';";
	$resultado = mysql_query($query, $conn);
	if($fila = mysql_fetch_row($resultado)){
		$valido=false;
		$error=$error."Nombre de usuario ya existe<br>";
	}
	mysql_free_result($resultado);
	if($nombre==""){
		$valido=false;
		$error=$error."Ingrese Nombre<br>";
	}
	if($apellido==""){
		$valido=false;
		$error=$error."Ingrese Apellido<br>";
	}
	if($direccion==""){
		$valido=false;
		$error=$error."Ingrese direccion<br>";
	}
	if($clave1!=$clave2){
		$valido=false;
		$error=$error."La clave no coincide<br>";
	}
	if($correo==""){
		$valido=false;
		$error=$error."Correo no valido<br>";
	}
	if($valido){
		$query = "INSERT INTO usuario VALUES (NULL,'$usuario','$clave1','$nombre','$apellido','$direccion','$correo',0);";
		mysql_query($query, $conn);
		header("Location: index.php");
	}else{
		$url="Location: registro.php?usuario=$usuario&nombre=$nombre&apellido=$apellido&direccion=$direccion&correo=$correo&error=$error";
		header($url);
	}
}else{
	echo "<form action=\"registro.php\" method=\"POST\">
		<div style=\"float:left;width:50%;\">
			<p>Usuario</p><p><input type=\"text\" name=\"usuario\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p><br />
			<p>Nombre(s)</p><p><input type=\"text\" name=\"nombre\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p><br />
			<p>Apellido(s)</p><p><input type=\"text\" name=\"apellido\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p><br />
			<p>Direccion</p><p><input type=\"text\" name=\"direccion\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p><br />
		</div>
		<div style=\"float:left;width:50%;\">
			<p>Contrase&ntildea </p><p><input type=\"password\" name=\"clave1\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p><br />
			<p>Repetir Contrase&ntildea </p><p><input type=\"password\" name=\"clave2\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p><br />
			<p>Correo</p><p><input type=\"email\" name=\"correo\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p><br />
			<br /><p><input type=\"submit\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p>
		</div>
	</form>";
}
?>
						</div>
					</div>
					<!-- Tab Registro -->
				</div>
				
				<!-- Footer -->
				<div id="footer">
					<div class="left">
						<a href="Index.php">Inicio</a>
						<span>|</span>
						<a href="registro.php">Registro</a>
						<span>|</span>
						<a href="login.php">Login</a>
					</div>
					<div class="right">
						&copy; Sitename.com. Design by <a href="http://chocotemplates.com" target="_blank" title="CSS Templates">ChocoTemplates.com</a>
					</div>
				</div>
				<!-- End Footer -->
				
			</div>
			<!-- End Container -->
			
		</div>
		<!-- End Content -->
		
	</div>
</div>
<!-- End Main -->
	
</body>
</html>