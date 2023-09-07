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
        $autor = [];
        foreach ($listaAutor as $autores) {
            $autor[] = Autor::deserializar($autores);
        }
        return $autor;
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
        $sql = 'INSERT INTO Autores (id, nombre_apellido VALUES (:id, :nombre_apeliido)';
        ConectarBD::escribir(
            sql: $sql,
            params: [
                ':id' => $params['id'],
                ':nombre_apellido' => $params['nombre_apellido'],
                
            ]
        );
    }

    public static function actualizar(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'UPDATE Autores SET  nombre_apellid =:nombre_apellidor WHERE id=:id';
        ConectarBD::escribir(
            sql: $sql,
            params: [
                ':id' => $params['id'],
                ':nombre_apellido' => $params['nombre-apellido'],
            ]
        );
    }
    public static function borrar(string $id)
    {
        $sql = 'DELETE FROM Autor WHERE id=:id';
        ConectarBD::escribir(sql: $sql, params: [':id' => $id]);
    }
}