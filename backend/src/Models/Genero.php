<?php
declare(strict_types=1);
namespace Raiz\Models;

use Raiz\Models\ModelBase;

class Genero extends ModelBase 
{
  public $id;
  public string $descripcion;

  Function __construct(string  $descripcion, mixed $id)
  {
      $this->descripcion = $descripcion;
      $this->id = $id;
  }
  public function serializar(): array
    {
      return [
        'descripcion' => $this->descripcion,
        'id' => $this->id

      ];
    }
    public static function deserializar(array $datos): self
    {
      return new self(
        descripcion: $datos['descripcion'],
        id: $datos['id']
    
      );
    }





  public function setDescripcion($nuevoDescricion)
  {
      $this->descripcion = $nuevoDescricion;
  }
  public function getDescripcion()
  {
      return $this->descripcion;
  }

  

};