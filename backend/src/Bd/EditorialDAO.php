<?php

namespace Raiz\Bd;

use Raiz\Aux\Serializador;
use Raiz\Bd\InterfaceDAO;

use Raiz\Models\Editorial;
use Raiz\Models\Socio;


class EditorialDAO implements InterfaceDAO
{

    public static function listar(): array
    {
        $sql = 'SELECT * FROM editorial';
        $listaeditorial = ConectarBD::leer(sql: $sql);
        $editorial = [];
        foreach ($listaeditorial as $editoriales) {
            $editorial[] = Editorial::deserializar($editoriales);
        }
        return $editorial;
    }
    public static function encontrarUno(string $id): ?Editorial
    {
        $sql = 'SELECT * FROM editorial WHERE id =:id;';
        $editorial = ConectarBD::leer(sql: $sql, params: [':id' => $id]);
        if (count($editorial) === 0) {
           return null;
        } else {
            $editorial= Editorial::deserializar($editorial[0]);
            return $editorial;
        }
    }

    public static function crear(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'INSERT INTO editorial (id, nombre) VALUES (:id, :nombre)';
        ConectarBD::escribir(
            sql: $sql,
            params: [
                ':id' => $params['id'],
                ':nombre' => $params['nombre'],
          
            ]
        );
    }

    public static function actualizar(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'UPDATE editorial SET editorial =: editorial WHERE id=:id';
        ConectarBD::escribir(
            sql: $sql,
            params: [
                ':id' => $params['id'],
                ':nombre' => $params['nombre'],
            ]
        );
    }
    public static function borrar(string $id)
    {
        $sql = 'DELETE FROM editorial WHERE id=:id';
        ConectarBD::escribir(sql: $sql, params: [':id' => $id]);
    }
}