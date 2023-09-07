<?php
namespace Raiz\Controllers;

use Raiz\Bd\AutorDAO;
use Raiz\Models\Autor;

class AutorController implements InterfaceController{
   
    //Clase que controla de acuerdo a lo que pida la vista: 
    // --- CRUD --- 
    //  Listar 
    //  encontrar uno
    //  crear
    //  actualizar
    //  borrar  

    public static function listar(): array
    {
        $autor = [];
        $listadoAutor = AutorDAO::listar();
        foreach($listadoAutor as $Autor)
        {
            $autor[] = $Autor->serializar();
        }
        return $autor;

        
    }
    
    public static function encontrarUno(string $id): ?array
    {
        $autor = AutorDAO::encontrarUno($id);
        if($autor===null){
            return $autor;
        }else{
            return $autor->serializar();
        }
        
        
        
    }

    public static function crear(array $parametros): array
    {
        $autor = Autor::deserializar($parametros);
        AutorDAO::crear($autor);
        return $autor->serializar();
    }

    public static function actualizar(array $parametros): array
    {
        $autor = Autor::deserializar($parametros);
        AutorDAO::actualizar($autor);
        return $autor->serializar();
    }

    public static function borrar(string $id):void
    {
        AutorDAO::borrar($id);
        
    }
    
    


}