<?php

namespace Raiz\Bd;

use Raiz\Aux\Serializador;
use Raiz\Bd\InterfaceDAO;
use Raiz\Models\Genero;

class GeneroDAO implements InterfaceDAO
{

    public static function listar(): array
    {
        $sql = 'SELECT * FROM Genero';
        $listagenero = ConectarBD::leer(sql: $sql);
        $genero = [];
        foreach ($listagenero as $genero) {
            $genero[] = Genero::deserializar($genero);
        }
        return $genero;
    }
    public static function encontrarUno(string $id): ?Genero
    {
        $sql = 'SELECT * FROM Categoria WHERE id =:id;';
        $genero = ConectarBD::leer(sql: $sql, params: [':id' => $id]);
        if (count($genero) === 0) {
           return null;
        } else {
            $genero = Genero::deserializar($genero[0]);
            return $genero;
        }
    }

    public static function crear(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'INSERT INTO Genero (id, descripcion) VALUES (:id, :descripcion)';
        ConectarBD::escribir(
            sql: $sql,
            params: [
                ':id' => $params['id'],
                ':descripcion' => $params['descripcion'],
          
            ]
        );
    }

    public static function actualizar(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'UPDATE Genero SET Genero =:Genero WHERE id=:id';
        ConectarBD::escribir(
            sql: $sql,
            params: [
                ':id' => $params['id'],
                ':descripcion' => $params['descripcion'],
            ]
        );
    }
    public static function borrar(string $id)
    {
        $sql = 'DELETE FROM Genero WHERE id=:id';
        ConectarBD::escribir(sql: $sql, params: [':id' => $id]);
    }
}