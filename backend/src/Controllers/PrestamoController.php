<?php
namespace Raiz\Controllers;

use Raiz\Bd\PrestamoDAO;
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
    
    public static function encontrarUno(string $id): ?array
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
        $prestamo = Prestamo::deserializar($parametros);
        PrestamoDAO::crear($prestamo);
        return $prestamo->serializar();
    }

    public static function actualizar(array $parametros): array
    {
        $prestamo = Prestamo::deserializar($parametros);
        PrestamoDAO::actualizar($prestamo);
        return $prestamo->serializar();
    }

    public static function borrar(string $id):void
    {
        PrestamoDAO::borrar($id);
        
    }
    public function verificarLibroDevuelvo($id)
    {

    } 
    

    public function calcularDiasRetraso($id)
    {
        
    }
}