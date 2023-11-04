<?php
declare(strict_types=1);
namespace Raiz\Models;

use Raiz\Models\ModelBase;

class Categoria extends ModelBase 
{
  public $id;
  public $descripcion;

  Function __construct( mixed $id,string  $descripcion)
  {   
      $this->id = $id;
      $this->descripcion = $descripcion;
      
  }

  public function serializar(): array
  {
    return [
      'id' => $this->id,
      'descripcion' => $this->descripcion
      

    ];
  }
  public static function deserializar(array $datos): self
  {
    return new self(
      id: $datos['id'],
      descripcion: $datos['descripcion']
      
  
    );
  }

  public function setNombre($nuevoDescricion)
  {
      $this->descripcion = $nuevoDescricion;
  }
  public function getNombre()
  {
      return $this->descripcion;
  }

 

};
