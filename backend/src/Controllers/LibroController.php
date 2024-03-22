<?php
namespace Raiz\Controllers;


use Raiz\Bd\LibroDAO;
use Raiz\Models\Libro;
use Raiz\Bd\AutorDAO;
use Raiz\Bd\CategoriaDAO;
use Raiz\Bd\GeneroDAO;
use Raiz\Bd\EditorialDAO;
use Raiz\Models\Autor;

class LibroController implements InterfaceController{

    //Clase que controla de acuerdo a lo que pida la vista: 
    // --- CRUD --- 
    //  Listar 
    //  encontrar uno
    //  crear
    //  actualizar
    //  borrar  

    public static function listar(): array
    {
        $libros = [];
        $listadoLibros = LibroDAO::listar();
     
        foreach($listadoLibros as $libro){
        
            $libros[] = $libro->serializar();
            
        }
        
        return $libros;

        
    }
    
    public static function encontrarUno(mixed $id): ?array
    {
        $Libro = LibroDAO::encontrarUno($id);
        
        if($Libro===null){
            return $Libro;
        }else{
            return $Libro->serializar();
        }
        
        
        
    }

    public static function crear(array $parametros): array
    {
        $parametros['genero'] = GeneroDAO::encontrarUno($parametros['genero']);
        $parametros['categoria'] = CategoriaDAO::encontrarUno($parametros['categoria']);
        $parametros['editorial'] = EditorialDAO::encontrarUno($parametros['editorial']);

        foreach ($parametros['autores'] as $autor) {
            $parametros["autor"][] = AutorDAO::encontrarUno($autor)->Serializar();
        }
      
        $Libro = new Libro(
            id:null,
            titulo: $parametros['titulo'],
            autorList:$parametros["autor"],
            editorial:$parametros["editorial"],
            cant_paginas:$parametros["cant_paginas"],
            anio:$parametros['anio'],
            genero:$parametros['genero'],
            categoria:$parametros["categoria"],
            
        );
        LibroDAO::crear($Libro);
        return $Libro->serializar();
    }

    public static function actualizar(array $parametros): array
    {
        $Libro = Libro::deserializar($parametros);
        LibroDAO::actualizar($Libro);
        return $Libro->serializar();
    }

    public function actualizarEstado(array $parametros){
        $Libro = Libro::deserializar($parametros);
        LibroDAO::actualizarEstado($Libro);
        return $Libro->serializar();
        
    }


    public static function borrar(mixed $id):void
    {
        LibroDAO::borrar($id);
        
    }
    
    


}

