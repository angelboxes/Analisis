<?php
include 'pruebaConexion.php';
include 'pruebaHistorialBusqueda.php';
class Conexions extends PHPUnit_Framework_TestCase
{	
  var $conn;  
  public function setUp(){ }
  public function tearDown(){ }
  public function testConexionBD()
  { 	$this->conn=Conexion();
	$this->assertTrue($this->conn==True);
  }

public function testConexionBD2()
  {	$this->conn=ConexionBD("catalogo");
	$this->assertTrue($this->conn==True);
  }
   
public function testbusquedaHistorial()
  {	$n=pruebaHistorialBusqueda();
	$this->assertGreaterThanOrEqual(0,$n);
  }

public function testinsertaHistorial()
  {	$this->conn=ConexionBD("catalogo");
	$n=ihistorialBusqueda(1,"nuevo",$this->conn);
	$this->assertTrue($n==True);
  }
}	

?>