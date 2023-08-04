<?php

namespace Raiz\Bd;

use Raiz\Aux\Serializador;
use Raiz\Bd\InterfaceDAO;
use Raiz\Models\Autor;




class AutorDAO implements InterfaceDAO
{

    public static function listar(): array
    {
        $sql = 'SELECT * FROM Autores';
        $listaAutor = ConectarBD::leer(sql: $sql);
        $Autor = [];
        foreach ($listaAutor as $Autor) {
            $Autor[] = Autor::deserializar($Autor);
        }
        return $Autor;
    }
    public static function encontrarUno(string $id): ?Autor
    {
        $sql = 'SELECT * FROM Autores WHERE id =:id;';
        $autor = ConectarBD::leer(sql: $sql, params: [':id' => $id]);
        if (count($autor) === 0) {
           return null;
        } else {
            $Autor= Autor::deserializar($autor[0]);
            return $Autor;
        }
    }

    public static function crear(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'INSERT INTO Autores (id, nombre-apellido VALUES (:id, :nombre-apeliido)';
        ConectarBD::escribir(
            sql: $sql,
            params: [
                ':id' => $params['id'],
                ':nombre-apellido' => $params['nombre-apellido'],
                
            ]
        );
    }

    public static function actualizar(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'UPDATE Autores SET Autores =:Autores WHERE id=:id';
        ConectarBD::escribir(
            sql: $sql,
            params: [
                ':id' => $params['id'],
                ':nombre-apellido' => $params['nombre-apellido'],
            ]
        );
    }
    public static function borrar(string $id)
    {
        $sql = 'DELETE FROM Autores WHERE id=:id';
        ConectarBD::escribir(sql: $sql, params: [':id' => $id]);
    }
}