<?php
declare(strict_types=1);
namespace Raiz\Models;

use Raiz\Models\Serializar;
use Raiz\Models\ModelBase;

class Autor extends ModelBase 
{
  private int $id;
  private string $nombre_Apellido;

  Function __construct(string $nombre_Apellido, int $id)
  {
      $this->nombre_Apellido = $nombre_Apellido;
      $this->id = $id;
  }

  public function setNombre($nuevoNombre)
  {
      $this->nombre_Apellido = $nuevoNombre;
  }
  public function getNombre()
  {
      return $this->nombre_Apellido;
  }

  public function getId()
  {
      return $this->id;
  }

};
