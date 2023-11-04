<?php
declare(strict_types=1);
namespace Raiz\Models;
use Raiz\Models\ModelBase;

class Editorial extends ModelBase 
{
  public $id;
  public $nombre;

  Function __construct( mixed $id, string  $nombre)
  {    
      $this->id = $id;
      $this->nombre = $nombre;

  }

  public function serializar(): array
  {
    return [
      
       'id' => $this->id,
       'nombre' => $this->nombre
    ];
  }
  public static function deserializar(array $datos): self
  {
    return new self(
      id : $datos['id'],
      nombre: $datos['nombre']
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