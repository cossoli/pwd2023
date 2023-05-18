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

  public function setNombre($nuevoDescricion)
  {
      $this->descripcion = $nuevoDescricion;
  }
  public function getNombre()
  {
      return $this->descripcion;
  }

  public function getid()
  {
      return $this->id;
  }

};
