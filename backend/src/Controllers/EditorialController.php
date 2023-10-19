<?php
namespace Raiz\Controllers;

use Raiz\Bd\EditorialDAO;
use Raiz\Models\Editorial;

class EditorialController implements InterfaceController{
   
    //Clase que controla de acuerdo a lo que pida la vista: 
    // --- CRUD --- 
    //  Listar 
    //  encontrar uno
    //  crear
    //  actualizar
    //  borrar  

    public static function listar(): array
    {
        $editorial = [];
        $listadoeditorial = EditorialDAO::listar();
        foreach($listadoeditorial as $editoriales){
            $editorial[] = $editoriales->serializar();
        }
        return $editorial;

        
    }
    
    public static function encontrarUno(string $id): ?array
    {
        $editorial = EditorialDAO::encontrarUno($id);
        if($editorial===null){
            return $editorial;
        }else{
            return $editorial->serializar();
        }
        
        
        
    }

    public static function crear(array $parametros): array
    {
        $editorial = Editorial::deserializar($parametros);
        EditorialDAO::crear($editorial);
        return $editorial->serializar();
    }

    public static function actualizar(array $parametros): array
    {
        $editorial = Editorial::deserializar($parametros);
        EditorialDAO:: actualizar($editorial);
        return $editorial->serializar();
    }

    public static function borrar(string $id):void
    {
        EditorialDAO::borrar($id);
        
    }
    
    


}