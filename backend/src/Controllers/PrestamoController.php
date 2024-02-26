<?php

namespace Raiz\Controllers;

use Raiz\Bd\LibroDAO;
use Raiz\Bd\PrestamoDAO;
use Raiz\Bd\SocioDAO;
use Raiz\Models\Prestamo;

class PrestamoController implements InterfaceController
{
    public static function listar(): array
    {
        $prestamos = [];
        $listaPrestamos = PrestamoDAO::listar();

        foreach ($listaPrestamos as $prestamo) {
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
    $parametros['id_socio'] = SocioDAO::encontrarUno($parametros['id_socio']);
    $parametros['id_libro']= LibroDAO::encontrarUno($parametros['id_libro']);

   
    // Crear el objeto Prestamo usando los datos proporcionados
    $prestamo = new Prestamo(
        id: $parametros['id'] ?? 0, // Si no se proporciona un ID, se establece en 0
        socio: $parametros['id_socio'], // Usar el objeto Socio encontrado
        libro:     $parametros['id_libro'], // Usar el objeto Libro encontrado
        fecha_dev: $parametros['fecha_dev'],
        fecha_desde: $parametros['fecha_desde'],
        fecha_hasta: $parametros['fecha_hasta']
    );

    // Guardar el préstamo en la base de datos
    PrestamoDAO::crear($prestamo);

    // Devolver el préstamo serializado como array
    return $prestamo->serializar();
}

    public static function actualizar(array $parametros): array
    {
        $prestamo = Prestamo::deserializar($parametros);
        PrestamoDAO::actualizar($prestamo);
        return $prestamo->serializar();
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
