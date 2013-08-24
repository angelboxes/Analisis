<?php
class Conexions extends PHPUnit_Framework_TestCase
{
  public function setUp(){ }
  public function tearDown(){ }
  public function testConexionBD()
  {
    // Prueba para probar que la conexión de la base de datos funcione 
    $conn = mysql_connect("localhost","root" ,"");
    $this->assertTrue($conn !== false);
  }
}	

?>