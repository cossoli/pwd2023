<?php
declare(strict_types=1);
namespace Raiz\Models;

use Raiz\Models\ModelBase;

class Libro extends ModelBase 
{
  private int $id;
  private string $titulo;
  private Autor $autor;
  private Genero $genero;
  private Editorial $editorial;
  private int $cant_paginas;
  private int $anio_publicacion;
  private string $estado;



  Function __construct(string $cant_paginas, int $id, 
       string $titulo, int $anio_publicacion, 
       string $estado, 
       Autor $autor , Genero $genero, Editorial $editorial)
  {
      $this->cant_paginas = $cant_paginas;
      $this->titulo = $titulo;
      $this->anio_publicacion= $anio_publicacion;
      $this->estado = $estado;
      $this->id = $id;
      $this->autor = $autor;
      $this->genero = $genero;
      $this->editorial = $editorial;

  }



  public function settitulo($nuevotitulo)
  {
      $this->titulo = $nuevotitulo;
  }
  public function gettitulo()
  {
      return $this->titulo;
  }

  public function setautor($nuevoautor)
  {
      $this->autor = $nuevoautor;
  }
  public function getautor()
  {
      return $this->autor;
  }
  public function seteditorial($nuevoeditorial)
  {
      $this->editorial = $nuevoeditorial;
  }
  public function geteditorial()
  {
      return $this->editorial;
  }
  public function setcant_paginas($nuevocant_paginas)
  {
      $this->cant_paginas = $nuevocant_paginas;
  }
  public function getcant_paginas()
  {
      return $this->cant_paginas;
  }

  public function setanio_publicacion($nuevoanio_publicacion)
  {
      $this->anio_publicacion = $nuevoanio_publicacion;
  }
  public function getanio_publicacion()
  {
      return $this->anio_publicacion;
  }

  public function setestado($nuevoestado)
  {
      $this->estado = $nuevoestado;
  }
  public function getestado()
  {
      return $this->estado;
  }

  
  public function setgenero($nuevogenero)
  {
      $this->genero = $nuevogenero;
  }
  public function getgenero()
  {
      return $this->genero;
  }


  public function getid()
  {
      return $this->id;
  }

};
