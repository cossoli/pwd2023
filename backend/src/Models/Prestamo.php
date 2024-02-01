<?php
declare(strict_types=1);
namespace Raiz\Models;


use Raiz\Models\ModelBase;


class Prestamo extends ModelBase 
{
  public  $id;
  public socio $socio;
  public libro $libro;
  public $fecha_desde;
  public $fecha_hasta; 
  public $fecha_dev = null;


  Function __construct(mixed $id, socio $socio, libro $libro, 
     string $fecha_desde , string $fecha_hasta, string $fecha_dev
      )
  
  {
      $this->id = $id;
      $this->socio = $socio;
      $this->libro = $libro;
      $this->fecha_desde= $fecha_desde;
      $this->fecha_hasta = $fecha_hasta;
      $this->fecha_dev = $fecha_dev;
         
 }

 public function serializar(): array
 {
   return [
       'id' => $this->id,
        'socio' => $this->socio,
       'libro' => $this->libro,
       'fecha_desde'  => $this-> fecha_desde,
       'fecha_hasta'=> $this->fecha_hasta,
       'fecha_dev'=> $this->fecha_dev
   ];
 }


 

 public static function deserializar(array $datos): self
 {
   return new self(
        id : $datos['id'],
        socio:$datos['socio'],
        libro:$datos   ['libro'],    
        fecha_desde: $datos ['fecha_desde'],
        fecha_hasta:$datos['fecha_hasta'],
        fecha_dev:$datos['fecha_dev']

   );                       
 }





function diasRetraso($id_libro): int {
    // Obtener la fecha actual
    
    $desde= $this->fecha_desde;
    $hasta= $this->fecha_hasta;
    $dev =$this->fecha_dev; 
    
    
// Obtener la fecha de devolución del libro (ejemplo)
    // Aquí deberías reemplazar esta línea con la lógica para obtener la fecha de devolución del libro basada en su ID
    
 // Fecha de devolución del libro (ejemplo)
    
    
    
// Calcular la diferencia en días entre la fecha actual y la fecha de devolución
    


   
//$diferencia = $fecha_desde->diff($hasta);
    
    $
//$dias_retraso = $diferencia->days;
    
    
    
   

    
// Verificar si el libro está dentro del rango de días permitido
    $dias_permitidos = 7; // Cantidad de días permitidos (ejemplo)
    if ($dias_retraso <= $dias_permitidos) {
        
       
return 0; // Aún está dentro del rango de días permitido
    } 
   
else {
        
       
return $dias_retraso; // Devolver la cantidad de días de retraso
    }
}

function cantLibrosPrestados($id_socio): int {
    
   
  // Aquí deberías reemplazar esta línea con la lógica para obtener la cantidad de libros prestados al socio basada en su ID
      
     
  //$libros_prestados = obtenerLibrosPrestados($id_socio); // Obtener libros prestados al socio (ejemplo)
      
      
      
  // Obtener la cantidad de libros prestados al socio
      
      $
  $cantidad_libros_prestados = count($libros_prestados);
      
      
      
     
  return $cantidad_libros_prestados;
  }
  
  // Función de ejemplo para obtener libros prestados al socio (debes adaptarla según tus necesidades)
  function obtenerLibrosPrestados($id_socio): array {
      // Aquí deberías implementar la lógica para obtener los libros prestados al socio según su ID
      // Puedes hacer consultas a una base de datos u obtener los datos de algún otro origen de datos
      
      // Ejemplo: retornar una lista de libros prestados al socio
      $libros = [
          ["titulo" => "Libro 1", "autor" => "Autor 1"],
          ["titulo" => "Libro 2", "autor" => "Autor 2"],
          [       
  "titulo" => "Libro 3", "autor" => "Autor 3"],
      ];
      
      return $libros;
  }
};
