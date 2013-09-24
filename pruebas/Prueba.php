<?php
include 'pruebaConexion.php';
include 'pruebaHistorialBusqueda.php';
class Conexions extends PHPUnit_Extensions_SeleniumTestCase
{	
  var $conn;  
    protected $captureScreenshotOnFailure = TRUE;
    protected $screenshotPath = 'C:\xampp\htdocs\Analisis\screenshots';
    protected $screenshotUrl = 'http://localhost/screenshots';


   protected function setUp()
    {
         $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://localhost/index.php');
	$this->setPort(8887);
    }

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