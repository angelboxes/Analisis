<?php
class Conexions PHPUnit_Framework_TestCase
{
  public function setUp(){ }
  public function tearDown(){ }
  public function ConexionIsValid()
  {
    // Prueba para probar que la conexi�n de la base de datos funcione 
    $conn = mysql_connect("localhost","root" ,"");
    $this->assertTrue($conn !== false);
  }
}	

?>