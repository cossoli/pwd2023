<?php
declare(strict_types=1);
namespace Raiz\Models;

use Raiz\Models\ModelBase;

class Categoria extends ModelBase 
{
  private int $id;
  private string $descripcion;

  Function __construct(string  $descripcion, int $id)
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






  public function setNombre($nuevoDescricion)
  {
      $this->descripcion = $nuevoDescricion;
  }
  public function getNombre()
  {
      return $this->descripcion;
  }

 

};
