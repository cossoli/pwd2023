<?php
declare(strict_types=1);
namespace Raiz\Models;

class Socio extends Persona{
    
  private int $id;
  private string $nombre_Apellido;
  private string $fecha_alta;
  private int $activo;
  private int $telefono;
  private string $direccion;



  Function __construct(int $id,string $fecha_alta,int $activo,
          int $telefono,string $direccion ,string $nombre_Apellido )
  
  {
      $this->id = $id;
      $this->nombre_Apellido = $nombre_Apellido;
      $this->fecha_alta = $fecha_alta;
      $this->activo = $activo;
      $this->telefono = $telefono;
      $this->direccion=$direccion;
      
  }

  public function setfecha_alta($nuevofecha)
  {
      $this->fecha_alta = $nuevofecha;
  }
  public function getfecha()

  {
      return $this->fecha_alta;
  }
  public function setNombre($nuevoNombre)
  {
      $this->nombre_Apellido = $nuevoNombre;
  }
  public function getNombre()
  {
      return $this->nombre_Apellido;
  }

  public function setactivo($nuevoactivo)
  {
      $this->activo = $nuevoactivo;
  }
  public function getactivo()
  {
      return $this->activo;
  }

  public function settelefono($nuevotelefono)
  {
      $this->telefono= $nuevotelefono;
  }
  public function gettelefono()
  {
      return $this->telefono;
  }
  public function setdireccion($nuevodireccion)
  {
      $this->direccion = $nuevodireccion;
  }
  public function getdireccion()
  {
      return $this->direccion;
  }
  
  public function getid()
  {
      return $this->id;
  }

}

