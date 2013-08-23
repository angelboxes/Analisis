<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
			<h1 id="logo"><a href="#">Urgan Gear</a></h1>
			<div id="navigation">
				<ul>
				    <li><a href="#">Inicio</a></li>
					<li><a href="#">Soporte</a></li>
					<li><a href="#">Cuenta</a></li>
					<li><a href="#">Mis anuncios</a></li>
					<li class="last"><a href="#">Contacto</a></li>
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
					<input type="submit" class="search-submit" value="GO" />
				</form>
			</div>
			<div class="search">
				<form action="index.php" method="POST">
					<span class="field"><select name="categoria">
						<?php
							$conn = mysql_connect("localhost","root" ,"");
							mysql_select_db("catalogo", $conn);
							$query = "SELECT * FROM categoria";
							$resultado = mysql_query($query, $conn) or die(mysql_error());
							while ($fila = mysql_fetch_assoc($resultado)) {
								echo "<option value=\"".$fila['categoria']."\">".$fila['categoria']."</option>";
							}
						?></select></span>
						<input type="hidden" name="tipo" value="2" />
					<input type="submit" class="search-submit" value="GO" />
				</form>
			</div>
		</div>
		<!--Busqueda-->
		
		<!-- Content -->
		<div id="content">
			
			<!-- Tabs -->
			<div class="tabs">
				<ul>
				    <li><a href="#" class="active"><span>Productos</span></a></li>
					<li><a href="#" class="active"><span>Nuevo Anuncio</span></a></li>
				</ul>
			</div>
			<!-- Tabs -->
			
			<!-- Container -->
			<div id="container">
				<div class="tabbed">
					<!-- Tab Productos -->
					<div class="tab-content" style="display:block;">
					<?php
					if($_POST){
						if($_POST['tipo']==1){
							$busqueda=$_POST['buscar'];
							$conn = mysql_connect("localhost","root" ,"");
							mysql_select_db("catalogo", $conn);
							$query = "SELECT * FROM anuncio WHERE producto like '%$busqueda%' or descripccion like '%$busqueda%' ORDER BY prioridad desc;";
							$resultado = mysql_query($query, $conn);;
							while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
								echo "<div class=\"items\">";
								echo "<div class=\"cl\">&nbsp;</div>";
								echo "<ul>";
								echo "<li>";
								echo "<div class=\"image\">";
									$query2 = "SELECT imagen FROM imagen WHERE id_anuncio=$fila[0];";
									$resultado2 = mysql_query($query2, $conn);;
									if($fila2 = mysql_fetch_array($resultado2, MYSQL_NUM)){
										echo "<a href=\"#\"><img style=\"width:190px\" src=\"uploads/$fila2[0]\" alt=\"\" /></a>";
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
								echo "</ul>";
								echo "<div class=\"cl\">&nbsp;</div>";
								echo "</div>";
							}
							mysql_free_result($resultado);
						}
						if($_POST['tipo']==2){
							$busqueda=$_POST['categoria'];
							$conn = mysql_connect("localhost","root" ,"");
							mysql_select_db("catalogo", $conn);
							$query = "SELECT * FROM anuncio WHERE categoria='$busqueda' ORDER BY prioridad desc;";
							$resultado = mysql_query($query, $conn);;
							while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
								echo "<div class=\"items\">";
								echo "<div class=\"cl\">&nbsp;</div>";
								echo "<ul>";
								echo "<li>";
								echo "<div class=\"image\">";
									$query2 = "SELECT imagen FROM imagen WHERE id_anuncio=$fila[0];";
									$resultado2 = mysql_query($query2, $conn);;
									if($fila2 = mysql_fetch_array($resultado2, MYSQL_NUM)){
										echo "<a href=\"#\"><img style=\"width:190px\" src=\"uploads/$fila2[0]\" alt=\"\" /></a>";
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
								echo "</ul>";
								echo "<div class=\"cl\">&nbsp;</div>";
								echo "</div>";
							}
							mysql_free_result($resultado);
						}
					}else{
						$conn = mysql_connect("localhost","root" ,"");
						mysql_select_db("catalogo", $conn);
						$query = "SELECT * FROM anuncio ORDER BY prioridad desc;";
						$resultado = mysql_query($query, $conn);;
						while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
							echo "<div class=\"items\">";
							echo "<div class=\"cl\">&nbsp;</div>";
							echo "<ul>";
							echo "<li>";
							echo "<div class=\"image\">";
								$query2 = "SELECT imagen FROM imagen WHERE id_anuncio=$fila[0];";
								$resultado2 = mysql_query($query2, $conn);;
								if($fila2 = mysql_fetch_array($resultado2, MYSQL_NUM)){
									echo "<a href=\"#\"><img style=\"width:190px\" src=\"uploads/$fila2[0]\" alt=\"\" /></a>";
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
							echo "</ul>";
							echo "<div class=\"cl\">&nbsp;</div>";
							echo "</div>";
						}
						mysql_free_result($resultado);
					}
					?>
					</div>
					<!-- Tab Productos -->
				
					<!-- Tab Nuevo Anuncio -->
					<div class="tab-content" style="display:block;">
						<div>
							<form action="phpNuevoAnuncio.php" method="POST" enctype="multipart/form-data">
								<div style="float:left;width:50%;">
									<p>Imagen del Producto</p>
									<input type="hidden" name="MAX_FILE_SIZE" value="700000" />
									<p><input type="file" name="imagen1" style="width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK" /></p>
									<br />
									<p><input type="file" name="imagen2" style="width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK" /></p>
									<br />
									<p><input type="file" name="imagen3" style="width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK" /></p>
									<br /><br /><br /><br />
									<p>Categoria</p>
									<p><select name="categoria" style="width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK">
										<?php
											$conn = mysql_connect("localhost","root" ,"");
											mysql_select_db("catalogo", $conn);
											$query = "SELECT * FROM categoria";
											$resultado = mysql_query($query, $conn) or die(mysql_error());
											while ($fila = mysql_fetch_assoc($resultado)) {
												echo "<option value=\"".$fila['categoria']."\">".$fila['categoria']."</option>";
											}
										?>
									</select></p>
									<br />
									<p>Condicion</p>
									<p><select name="condicion" style="width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK">
										<option value="Nuevo">Nuevo</option>
										<option value="Bueno">Bueno</option>
										<option value="Regular">Regular</option>
										<option value="Malo">Malo</option>
									</select></p>
								</div>
								<div style="float:left;width:50%;">
									<p>Nombre del Producto</p>
									<p><input type="text" name="producto" style="width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK" /></p>
									<br />
									<p>Descripccion</p>
									<p><textarea name="descripccion" rows="3" style="width:90%;background:WhiteSmoke;border:0;color:BLACK"></textarea></p>
									<br />
									<p>Precio "En Quetzales"</p>
									<p><input type="number" name="precio" step="any" min="0" value="0.00" style="width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK" /></p>
									<br />
									<p>Cantidad "Numero de unidades"</p>
									<p><input type="number" name="cantidad" min="1" value="1" style="width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK" /></p>
									<br />
									<p>Fecha de expiracion</p>
									<p><input type="date" name="fecha" style="width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK" /></p>
									<br />
									<input type="hidden" name="prioridad" value="0" />
									
									<br /><br />
									<p><input type="submit" style="width:90%;height:25px;background:WhiteSmoke;border:0;color:BLACK" /></p>
								</div>
							</form>
						</div>
					</div>
					<!-- Tab Nuevo Anuncio -->
				</div>
				
				<!-- Footer -->
				<div id="footer">
					<div class="left">
						<a href="#">Home</a>
						<span>|</span>
						<a href="#">Support</a>
						<span>|</span>
						<a href="#">My Account</a>
						<span>|</span>
						<a href="#">The Store</a>
						<span>|</span>
						<a href="#">Contact</a>
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