<?php

namespace Raiz\Bd;

use Raiz\Aux\Serializador;
use Raiz\Bd\InterfaceDAO;
use Raiz\Models\Socio;


class SocioDAO implements InterfaceDAO
{

    public static function listar(): array
    {
        $sql = 'SELECT * FROM socios';
        $listaSocios = ConectarBD::leer(sql: $sql);
        $socios = [];
        foreach ($listaSocios as $socio) {
            $socios[] = Socio::deserializar($socio);
        }
        return $socios;
    }
    public static function encontrarUno(string $id): ?Socio
    {
        $sql = 'SELECT * FROM socios WHERE id =:id;';
        $socio = ConectarBD::leer(sql: $sql, params: [':id' => $id]);
        if (count($socio) === 0) {
           return null;
        } else {
            $socio = Socio::deserializar($socio[0]);
            return $socio;
        }
    }

    public static function crear(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'INSERT INTO socios (id, nombre_apellido, fecha_alta, direccion,telefono,activo) 
        VALUES (:id, :nombre_apellido, :fecha_alta, :direccion, :telefono, :activo )';
        ConectarBD::escribir(
            sql: $sql,
            params: [
                ':id' => $params['id'],
                ':nombre_apellido' => $params['nombre_apellido'],
                ':fecha_alta' => $params['fecha_alta'],
                ':direccion' => $params['direccion'],
                ':telefono' => $params['telefono'],
                ':activo' => $params['activo']
            ]
        );
    }

    public static function actualizar(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'UPDATE socios SET nombre_apellido =:nombre_apellido WHERE id=:id';
        ConectarBD::escribir(
            sql: $sql,
            params: [
                ':id' => $params['id'],
                ':nombre_apellido' => $params['nombre_apellido'],
            ]
        );
    }
    public static function borrar(string $id)
    {
        $sql = 'DELETE FROM socios WHERE id=:id';
        ConectarBD::escribir(sql: $sql, params: [':id' => $id]);
    }
}
