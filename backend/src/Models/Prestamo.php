<?php
declare(strict_types=1);

namespace Raiz\Models;


use PhpParser\Node\Stmt\Static_;

class Prestamo extends ModelBase 
{
    public int $id;
    public Socio $socio;
    public Libro $libro;
    public string $fecha_desde;
    public string $fecha_hasta; 
    public ?string $fecha_dev = null;

    public function __construct(
        int $id, 
        Socio $socio, 
        Libro $libro, 
        string $fecha_desde, 
        string $fecha_hasta, 
        ?string $fecha_dev = null
    ) {
        $this->id = $id;
        $this->socio = $socio;
        $this->libro = $libro;
        $this->fecha_desde = $fecha_desde;
        $this->fecha_hasta = $fecha_hasta;
        $this->fecha_dev = $fecha_dev;
    }

    public function serializar(): array
    {
        return [
            'id' => $this->getId(),
             
            'socio' => $this->socio->serializar(),
            'libro' => $this->libro->serializar(),
            'fecha_desde' => $this->fecha_desde,
            'fecha_hasta' => $this->fecha_hasta,
            'fecha_dev' => $this->fecha_dev
        ];
    }

    public static function deserializar(array $datos): self
{
    return new self(
        id: $datos['id'] ?? 0, // Usamos el operador de fusión null-coalesce para manejar el caso en que $datos['id'] no esté definido
        socio: Socio::deserializar($datos['id_socio'] ?? []), // Usamos el operador de fusión null-coalesce y proporcionamos un arreglo vacío como valor predeterminado para Socio::deserializar
        libro: Libro::deserializar($datos['id_socio'] ?? []), // Usamos el operador de fusión null-coalesce y proporcionamos un arreglo vacío como valor predeterminado para Libro::deserializar
        fecha_desde: $datos['fecha_desde'] ?? '',
        fecha_hasta: $datos['fecha_hasta'] ?? '',
        fecha_dev: $datos['fecha_dev'] ?? null // Usamos el operador de fusión null-coalesce para manejar el caso en que $datos['fecha_dev'] no esté definido
    );
}


    public function diasRetraso(): int
    {
        if (!$this->fecha_dev) {
            return 0; // No hay retraso si no hay fecha de devolución
        }
        
        $fecha_devolucion = new \DateTime($this->fecha_dev);
        $fecha_hasta = new \DateTime($this->fecha_hasta);
        $diferencia = $fecha_devolucion->diff($fecha_hasta);
        return $diferencia->days;
    }

    public function cantLibrosPrestados(): int
    {
        // Aquí implementamos la lógica para obtener la cantidad de libros prestados al socio
        return obtenerCantidadLibrosPrestados($this->socio->id);
    }
}

// Función de ejemplo para obtener la cantidad de libros prestados al socio (debes adaptarla según tus necesidades)
function obtenerCantidadLibrosPrestados(int $id_socio): int
{
    // Aquí implementamos la lógica para obtener la cantidad de libros prestados al socio
    // Puedes hacer consultas a una base de datos u obtener los datos de algún otro origen de datos
    
    // Ejemplo: retornar una cantidad aleatoria de libros prestados al socio
    return rand(0, 10);
}