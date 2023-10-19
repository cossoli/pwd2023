<?php

namespace Raiz\Bd;

use Raiz\Aux\Serializador;
use Raiz\Bd\InterfaceDAO;
use Raiz\Models\Prestamo;
use Raiz\Models\Socio;


class PrestamoDAO implements InterfaceDAO
{

    public static function listar(): array
    {
        $sql = 'SELECT * FROM prestamos';
        $listaPrestamo = ConectarBD::leer(sql: $sql);
        $prestamo = [];
        foreach ($listaPrestamo as $prestamos) {
            $prestamo[] = Prestamo::deserializar($prestamos);
        }
        return $prestamo;
    }
    public static function encontrarUno(string $id): ?Prestamo
    {
        $sql = 'SELECT * FROM prestamos WHERE id =:id;';
        $prestamo = ConectarBD::leer(sql: $sql, params: [':id' => $id]);
        if (count($prestamo) === 0) {
           return null;
        } else {
            $prestamo= Prestamo::deserializar($prestamo[0]);
            return $prestamo;
        }
    }

    public static function crear(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'INSERT INTO prestamos (id, socio, libro) VALUES (:id, :socio, :libro)';
        ConectarBD::escribir(
            sql: $sql,
            params: [
                ':id' => $params['id'],
                ':socio' => $params['socio'],
                ':libro' => $params['libro']
            ]
        );
    }

    public static function actualizar(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'UPDATE Prestamos SET Prestamos =:Prestamos WHERE id=:id';
        ConectarBD::escribir(
            sql: $sql,
            params: [
                ':id' => $params['id'],
                ':socio' => $params['socio'],
            ]
        );
    }
    public static function borrar(string $id)
    {
        $sql = 'DELETE FROM prestamos WHERE id=:id';
        ConectarBD::escribir(sql: $sql, params: [':id' => $id]);
    }
}
