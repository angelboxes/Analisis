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
				    <li><a href="#" class="active"><span>Login</span></a></li>
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
	$error=$_GET['error'];
	echo "<form action=\"login.php\" method=\"POST\"><div style=\"float:left;width:35%;\"><p> <br /> </p></div><div style=\"float:left;width:30%;\">
			<p>Usuario</p><p><input type=\"text\" name=\"usuario\" value=\"$usuario\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p><br />
			<p>Contrase&ntildea </p><p><input type=\"password\" name=\"clave\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p><br />
			<br />$error
			<br /><p><input type=\"submit\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p>
		</div><div style=\"float:left;width:35%;\"><p> <br /> </p></div></form>";
}else if($_POST){
	$usuario=$_POST['usuario'];
	$clave=$_POST['clave'];
	$conn = mysql_connect("localhost","root" ,"");
	mysql_select_db("catalogo", $conn);
	$error="";
	$query = "SELECT id_usuario, username FROM usuario WHERE username like '$usuario' AND password like '$clave';";
	$resultado = mysql_query($query, $conn);
	if($fila = mysql_fetch_row($resultado)){
		$_SESSION['id_usuario']=$fila[0];
		$_SESSION['usuario']=$fila[1];
		header("Location: index.php");
	}else{
		$error=$error."El nombre de usuario y/o la contraseña estan incorrectos<br>";
		$url="Location: login.php?usuario=$usuario";
		header($url);
	}
	mysql_free_result($resultado);
}else{
	echo "<form action=\"login.php\" method=\"POST\"><div style=\"float:left;width:35%;\"><p> <br /> </p></div><div style=\"float:left;width:30%;\">
			<p>Usuario</p><p><input type=\"text\" name=\"usuario\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p><br />
			<p>Contrase&ntildea </p><p><input type=\"password\" name=\"clave\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p><br />
			<br /><p><input type=\"submit\" style=\"width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK\" /></p>
		</div><div style=\"float:left;width:35%;\"><p> <br /> </p></div></form>";
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