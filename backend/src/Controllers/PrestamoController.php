<?php
namespace Raiz\Controllers;

use Raiz\Bd\LibroDAO;
use Raiz\Bd\PrestamoDAO;
use Raiz\Bd\SocioDAO;
use Raiz\Models\Prestamo;

class PrestamoController implements InterfaceController{
   
    //Clase que controla de acuerdo a lo que pida la vista: 
    // --- CRUD --- 
    //  Listar 
    //  encontrar uno
    //  crear
    //  actualizar
    //  borrar  

    public static function listar(): array
    {
        $prestamo = [];
        $listadoprestamo = PrestamoDAO::listar();
        foreach($listadoprestamo as $prestamo){
            $prestamo[] = $prestamo->serializar();
        }
        return $prestamo;

        
    }
    
    public static function encontrarUno(mixed $id): ?array
    {
        $prestamo = PrestamoDAO::encontrarUno($id);
        if($prestamo===null){
            return $prestamo;
        }else{
            return $prestamo->serializar();
        }
        
        
        
    }

    public static function crear(array $parametros): array
    {
        foreach($parametros['socio'] as $socio){
            $parametros[$socio][] = SocioDAO::encontrarUno($socio);
        }
        
        foreach($parametros['libro'] as $libro){
            $parametros[$libro][] = LibroDAO::encontrarUno($libro);
        }
        $prestamo = new Prestamo(
            
            id: $parametros['id'], 
            socio: $parametros['socio'],
            libro: $parametros["libro"],
            fecha_dev :$parametros["fecha_dev"],
            fecha_desde:$parametros["fecha_desde"],
            fecha_hasta: $parametros['fecha_hasta'],
        );
        PrestamoDAO::crear($prestamo);
        return $prestamo->serializar();
    }

    public static function actualizar(array $parametros): array
    {
        $prestamo = Prestamo::deserializar($parametros);
        PrestamoDAO::actualizar($prestamo);
        return $prestamo->serializar();
    }

    public static function borrar(mixed $id):void
    {
        PrestamoDAO::borrar($id);
        
    }
    public function verificarLibroDevuelvo(mixed $id)
    {

    } 
    

    public function calcularDiasRetraso(mixed$id)
    {
        
    }
}