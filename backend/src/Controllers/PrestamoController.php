<?php

namespace Raiz\Controllers;

use Raiz\Bd\LibroDAO;
use Raiz\Bd\PrestamoDAO;
use Raiz\Bd\SocioDAO;
use Raiz\Models\Libro;
use Raiz\Models\Prestamo;


class PrestamoController implements InterfaceController
{
    public static function listar(): array
    {
        $prestamos = [];
        $listaPrestamos = PrestamoDAO::listar();

        foreach ($listaPrestamos as $prestamo) {
           
          //  if($prestamo->getFechaDev()=== null )
        
            $prestamos[] = $prestamo->serializar();
        
        }
        return $prestamos;
    }

    public static function encontrarUno(mixed $id): ?array
    {
        $prestamo = PrestamoDAO::encontrarUno($id);

        if ($prestamo === null) {
            return null;
        } else {
            return $prestamo->serializar();
        }
    }

    public static function crear(array $parametros): array
{
    // Buscar el socio y el libro por sus IDs
    $parametros['socio'] = SocioDAO::encontrarUno($parametros['socio']);
    $parametros['libro']= LibroDAO::encontrarUno($parametros['libro']);

   if ($parametros['libro']->getEstado() === Libro::ACTIVO ){
   
    // Crear el objeto Prestamo usando los datos proporcionados
    $prestamo = new Prestamo(
        
        id: $parametros['id'] ?? 0, // Si no se proporciona un ID, se establece en 0
        socio: $parametros['socio'], // Usar el objeto Socio encontrado
        libro:     $parametros['libro'], // Usar el objeto Libro encontrado
        fecha_desde: $parametros['fecha_desde'],
        fecha_hasta: $parametros['fecha_hasta'],
        fecha_dev: $parametros['fecha_dev']
    );

    // Guardar el préstamo en la base de datos
    PrestamoDAO::crear($prestamo);
    $parametros['libro']->setEstado() === (Libro::PRESTADO); 
    LibroDAO::actualizarEstado($parametros['libro']);

    // Devolver el préstamo serializado como array
    return $prestamo->serializar();
}
}
    public static function actualizar(array $parametros): array
    {
        
        $parametros['socio'] = SocioDAO::encontrarUno($parametros['socio']);
        $parametros['libro']= LibroDAO::encontrarUno($parametros['libro']);
       
        if ($parametros['libro']->getEstado() === Libro::PRESTADO ){
       
            $prestamo = Prestamo::deserializar($parametros);
       
            PrestamoDAO::actualizar($prestamo);
       
            $parametros['libro']->setEstado() === (Libro::ACTIVO); 
       
            LibroDAO::actualizarEstado($parametros['libro']);
       
            return $prestamo->serializar();
    }
    }
    public static function borrar(mixed $id): void
    {
        PrestamoDAO::borrar($id);
    }

    public function verificarLibroDevuelto(mixed $id)
    {
        // Implementa la lógica para verificar si un libro ha sido devuelto
    }

    public function calcularDiasRetraso(mixed $id)
    {
        // Implementa la lógica para calcular los días de retraso de un préstamo
    }
}
