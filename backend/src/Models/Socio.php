<?php
declare(strict_types=1);
namespace Raiz\Models;

use Raiz\Aux\Serializador;

class Socio extends ModelBase 
{
    
  private int $id;
  private string $nombre_apellido;
  private string $fecha_alta;
  private int $activo;
  private int $telefono;
  private string $direccion;



  Function __construct(int $id,string $fecha_alta,int $activo,
          int $telefono,string $direccion ,string $nombre_apellido )
  
  {
      $this->id = $id;
      $this->nombre_apellido = $nombre_apellido;
      $this->fecha_alta = $fecha_alta;
      $this->activo = $activo;
      $this->telefono = $telefono;
      $this->direccion=$direccion;
      
  }
  public function serializar(): array
  {
    return [
        'id' => $this->id,
        'nombre_apellido' => $this->nombre_apellido,
        'fecha_alta' => $this->fecha_alta,
        'activo'  => $this-> activo,
        'telefono'=> $this->telefono,
        'direccion'=> $this->direccion
    ];
  }
 
  public static function deserializar(array $datos): self
  {
    return new self(
        id : $datos['id'],
        nombre_apellido: $datos['nombre_apellido'],
       fecha_alta:$datos   ['fecha_alta'],
       activo: $datos ['activo'],
       telefono:$datos['telefono'],
       direccion:$datos['direccion']

    );
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
      $this->nombre_apellido = $nuevoNombre;
  }
  public function getNombre()
  {
      return $this->nombre_apellido;
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
  
  

}

