<?php
require_once('busqueda.php');
class Conexions extends PHPUnit_Framework_TestCase
{
  public function setUp(){ }
  public function tearDown(){ }
  public function testConexionBD()
  {
    // Prueba para probar que la conexión de la base de datos funcione 
    $conn = mysql_connect("localhost","root" ,"");
    $this->assertTrue($conn !== false);
    mysql_select_db("catalogo", $conn);
    $query = "SELECT * FROM categoria";
    $resultado = mysql_query($query, $conn) or die(mysql_error());
    $this->assertTrue($resultado !== false);
    $this->assertTrue(mysql_fetch_assoc($resultado)!==false);
    while ($fila = mysql_fetch_assoc($resultado)) {
	$this->AssertNotEmpty($fila['categoria']);
	}
  }

   public function testProducto(){
	$conn = mysql_connect("localhost","root" ,"");
	mysql_select_db("catalogo", $conn);
	$query = "SELECT * FROM anuncio ORDER BY prioridad desc LIMIT 0,8;";
	$resultado = mysql_query($query, $conn);
	$this->assertGreaterThan(-1,mostrarProducto($conn,$resultado));
	
   }
  
	
}	

?>