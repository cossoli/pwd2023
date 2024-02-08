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
        $listaPrestamos = ConectarBD::leer($sql);
        $prestamos = [];
        foreach ($listaPrestamos as $prestamoData) {
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
        $sql = 'INSERT INTO prestamos (libro_id, fecha_inicio, fecha_fin) VALUES (:libro_id, :fecha_inicio, :fecha_fin)';
        ConectarBD::escribir($sql, [
            ':libro_id' => $params['libro_id'],
            ':fecha_inicio' => $params['fecha_inicio'],
            ':fecha_fin' => $params['fecha_fin']
        ]);
    }

    public static function actualizar(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'UPDATE prestamos SET libro_id = :libro_id, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin WHERE id = :id';
        ConectarBD::escribir($sql, [
            ':id' => $params['id'],
            ':libro_id' => $params['libro_id'],
            ':fecha_inicio' => $params['fecha_inicio'],
            ':fecha_fin' => $params['fecha_fin']
        ]);
    }

    public static function borrar(string $id)
    {
        $sql = 'DELETE FROM prestamos WHERE id = :id';
        ConectarBD::escribir($sql, [':id' => $id]);
    }
}
