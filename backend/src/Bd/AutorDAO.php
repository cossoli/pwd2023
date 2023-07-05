<?php

namespace Raiz\Bd;

use Raiz\Aux\Serializador;
use Raiz\Bd\InterfaceDAO;
use Raiz\Models\Autor;

use Raiz\Models\Socio;


class AutorDAO implements InterfaceDAO
{

    public static function listar(): array
    {
        $sql = 'SELECT * FROM Autor';
        $listaAutor = ConectarBD::leer(sql: $sql);
        $Autor = [];
        foreach ($listaAutor as $Autor) {
            $Autor[] = Prestamo::deserializar($Autor);
        }
        return $Autor;
    }
    public static function encontrarUno(string $id): ?Autor
    {
        $sql = 'SELECT * FROM Autor WHERE id =:id;';
        $socio = ConectarBD::leer(sql: $sql, params: [':id' => $id]);
        if (count($socio) === 0) {
           return null;
        } else {
            $Autor= Autor::deserializar($socio[0]);
            return $Autor;
        }
    }

    public static function crear(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'INSERT INTO Autor (id, nombre-apellido VALUES (:id, :nombre-apeliido)';
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
        $sql = 'UPDATE Autor SET Autor =:Autor WHERE id=:id';
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
        $sql = 'DELETE FROM Autor WHERE id=:id';
        ConectarBD::escribir(sql: $sql, params: [':id' => $id]);
    }
}