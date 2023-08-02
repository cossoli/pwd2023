<?php
declare(strict_types=1);
namespace Raiz\Models;
use Raiz\Models\ModelBase;

class Editorial extends ModelBase 
{
  private int $id;
  private string $nombre;

  Function __construct(string  $nombre, int $id)
  {
      $this->nombre = $nombre;
      $this->id = $id;
  }

  public function serializar(): array
  {
    return [
      'nombre' => $this->nombre,
      'id' => $this->id

    ];
  }
  public static function deserializar(array $datos): self
  {
    return new self(
      nombre: $datos['nombre'],
      id : $datos['id']
  
    );
  }






  public function setNombre($nuevoNombre)
  {
      $this->nombre = $nuevoNombre;
  }
  public function getNombre()
  {
      return $this->nombre;
  }

 

};