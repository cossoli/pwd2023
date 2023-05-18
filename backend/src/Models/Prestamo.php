<?php
declare(strict_types=1);
namespace Raiz\Models;

use Raiz\Models\Serializar;
use Raiz\Models\ModelBase;
use Raiz\Models\date;


class Prestamo extends ModelBase 
{
  private int $id;
  private socio $socio;
  private libro $libro;
  private $fecha_desde;
  private $fecha_hasta; 
  private $fecha_dev;


  Function __construct(int $id )
  
  {
      $this->id = $id;
      
  }

  public function diasRetraso($id_libro):int 
  { 
      

     
  }
    public function cantLibrosPrestados($id_socio):int
    { 
        
     

    }
 
};
