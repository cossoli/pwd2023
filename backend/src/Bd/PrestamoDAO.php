<?php

namespace Raiz\Bd;

use Raiz\Aux\Serializador;
use Raiz\Bd\InterfaceDAO;
use Raiz\Models\Prestamo;

class PrestamoDAO implements InterfaceDAO
{
    public static function listar(): array
    {
        $sql = 'SELECT * FROM prestamos';
        $listaPrestamos = ConectarBD::leer( sql: $sql);
        $prestamos = [];
        foreach ($listaPrestamos as $prestamoData) {
          //  $prestamoData['socio'] = SocioDAO::encontrarUno($prestamoData['socio']);
          //  $prestamoData['libro'] = LibroDAO::encontrarUno($prestamoData['libro']);

            $prestamos[] = Prestamo::deserializar($prestamoData);
        }
        return $prestamos;
    }

    public static function encontrarUno(string $id): ?Prestamo
    {
        $sql = 'SELECT * FROM prestamos WHERE id = :id';
        $prestamoData = ConectarBD::leer($sql, [':id' => $id]);
        if (empty($prestamoData)) {
            return null; // Devuelve null si no se encuentra ningún préstamo
        } else {
            return Prestamo::deserializar($prestamoData[0]);
        }
    }

    public static function crear(Serializador $instancia): void
{
    $params = $instancia->serializar();
    $sql = 'INSERT INTO prestamos (id_socio, id_libro, fecha_dev, fecha_hasta, fecha_desde) 
            VALUES (:id_socio, :id_libro, :fecha_dev, :fecha_hasta, :fecha_desde)';
    ConectarBD::escribir($sql, [
        ':id_socio' => $params['id_socio'],
        ':id_libro' => $params['id_libro'],
        ':fecha_dev' => $params['fecha_dev'],
        ':fecha_hasta' => $params['fecha_hasta'],
        ':fecha_desde' => $params['fecha_desde']
    ]);
}
public static function actualizar(Serializador $instancia): void
{
    $params = $instancia->serializar();
    $sql = 'UPDATE prestamos SET id_socio = :id_socio, id_libro = :id_libro, fecha_dev = :fecha_dev, 
            fecha_desde = :fecha_desde, fecha_hasta = :fecha_hasta 
            WHERE id = :id';
    ConectarBD::escribir($sql, [
        ':id' => $params['id'],
        ':id_socio' => $params['id_socio'],
        ':id_libro' => $params['id_libro'],
        ':fecha_dev' => $params['fecha_dev'],
        ':fecha_hasta' => $params['fecha_hasta'],
        ':fecha_desde' => $params['fecha_desde'],
    ]);
}


    public static function borrar(string $id)
    {
        $sql = 'DELETE FROM prestamos WHERE id = :id';
        ConectarBD::escribir($sql, [':id' => $id]);
    }
}
