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
            'id' => $this->id,
            'socio' => $this->socio->serializar(),
            'libro' => $this->libro->serializar(),
            'fecha_desde' => $this->fecha_desde,
            'fecha_hasta' => $this->fecha_hasta,
            'fecha_dev' => $this->fecha_dev
        ];
    }

    public Static function deserializar(array $datos): self
    {
        return new self(
            $datos['id'],
            Socio::deserializar($datos['socio']),
            Libro::deserializar($datos['libro']),
            $datos['fecha_desde'],
            $datos['fecha_hasta'],
            $datos['fecha_dev']
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