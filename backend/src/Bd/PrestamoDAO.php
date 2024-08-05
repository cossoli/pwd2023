<?php

namespace Raiz\Bd;

use Raiz\Auxi\Serializador;
use Raiz\Bd\InterfaceDAO;
use Raiz\Models\Prestamo;
use PDO;

class PrestamoDAO implements InterfaceDAO
{
    public static function listar(): array
    {
        $sql = 'SELECT * FROM prestamos';

       $cnx = ConectarBD::conectar();
        $consulta = $cnx->prepare($sql);
        $consulta->execute();
        $listaPrestamos= $consulta->fetchAll(PDO::FETCH_ASSOC);
        $prestamos = [];
        foreach ($listaPrestamos as $prestamoData) {
            $prestamoData['socio'] = SocioDAO::encontrarUno($prestamoData['id_socio']);
            $prestamoData['libro'] = LibroDAO::encontrarUno($prestamoData['id_libro']);

            $prestamos[] = Prestamo::deserializar($prestamoData);
        }
        return $prestamos;

    }
  
    public static function encontrarUno(string $id): ?Prestamo
    {
        $sql = 'SELECT * FROM prestamos WHERE id = :id';
        $prestamoData = ConectarBD::leer($sql, [':id' => $id]);
        if (count($prestamoData) === 0 ) {
            return null; // Devuelve null si no se encuentra ningún préstamo
        } else {
            $prestamoData[0]['socio'] = SocioDAO::encontrarUno($prestamoData[0]['id_socio']);
            $prestamoData[0]['libro'] = LibroDAO::encontrarUno($prestamoData[0]['id_libro']);
            return Prestamo::deserializar($prestamoData[0]);
        }
    }

    public static function crear(Serializador $instancia): void
{
    $params = $instancia->serializar();
    
    $sql = 'INSERT INTO prestamos (id_socio, id_libro, fecha_dev, fecha_hasta, fecha_desde) 
            VALUES (:id_socio, :id_libro, :fecha_dev, :fecha_hasta, :fecha_desde)';
    ConectarBD::escribir(
        sql : $sql , 
        params : [
        ':id_socio' => $params['socio']['id'], 
        ':id_libro' => $params['libro']['id'],
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
    ConectarBD::escribir(
         sql:$sql,
         params: [
        ':id' => $params['id'],
        ':id_socio' => $params['socio'] ['id'],
        ':id_libro' => $params['libro']['id'],
        ':fecha_dev' => $params['fecha_dev'],
        ':fecha_hasta' => $params['fecha_hasta'],
        ':fecha_desde' => $params['fecha_desde'],
    ]);
}


    public static function borrar(string $id)
    {
        $sql = 'DELETE FROM prestamos WHERE id = :id';
        ConectarBD::escribir(sql: $sql, params: [':id' => $id]);
    }
}
