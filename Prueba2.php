<?php
include 'pruebaConexion.php';
include 'pruebaHistorialBusqueda.php';
class Conexions extends PHPUnit_Framework_TestCase
{	
  var $conn;  
  public function setUp(){ }
  public function tearDown(){ }

public function testConexionBD2()
  {	$this->conn=ConexionBD("catalogo");
	$this->assertTrue($this->conn==True);
  }
public function testbusquedaSugerida()
  {
	$usuario=1;
	$this->conn=ConexionBD("catalogo");
	$n=busquedaSugerida($usuario,$this->conn);
	$this->assertTrue($n->usuario==True);
	$this->assertGreaterThanOrEqual(0,$n->numeroBusquedas);
	$this->assertLessThanOrEqual(5,$n->numeroBusquedasMostradas);
	$this->assertLessThanOrEqual($n->numeroBusquedasMostradas,$n->numeroBusquedas);
  }
}
?>