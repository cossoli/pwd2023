<?php
declare(strict_types=1);
namespace Raiz\Models;

use Raiz\Models\Serializar;
use Raiz\Models\ModelBase;

class Autor extends ModelBase 
{
  private int $id;
  private string $nombre_apellido;

  Function __construct(string $nombre_apellido, int $id)
  {
      $this->nombre_apellido = $nombre_apellido;
      $this->id = $id;
  }

  public function Serializar(): array
  {
    return [
      'nombre_apellido' => $this->nombre_apellido,
      'id' => $this->id

    ];
  }
  public static function deserializar(array $datos): self
  {
    return new self(
      nombre_apellido: $datos['nombre_apellido'],
      id : $datos['id']
  
    );
  }
  public function setNombre($nuevoNombre)
  {
      $this->nombre_apellido = $nuevoNombre;
  }
  public function getNombre()
  {
      return $this->nombre_apellido;
  }

  

};
