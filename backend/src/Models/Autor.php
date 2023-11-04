<?php
declare(strict_types=1);
namespace Raiz\Models;

use Raiz\Models\Serializar;
use Raiz\Models\ModelBase;

class Autor extends ModelBase 
{
  public  $id;
  public  $nombre_apellido;

  Function __construct(string $nombre_apellido, mixed $id)
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
    return new self (
       id : $datos ['id'],
      nombre_apellido : $datos ['nombre_apellido']
       
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
