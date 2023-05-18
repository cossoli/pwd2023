<?php
declare(strict_types=1);
namespace Raiz\Models;

use Raiz\Models\ModelBase;

class Genero extends ModelBase 
{
  private int $id;
  private string $descripcion;

  Function __construct(string  $descripcion, int $id)
  {
      $this->descripcion = $descripcion;
      $this->id = $id;
  }

  public function setDescripcion($nuevoDescricion)
  {
      $this->descripcion = $nuevoDescricion;
  }
  public function getDescripcion()
  {
      return $this->descripcion;
  }

  public function getid()
  {
      return $this->id;
  }

};