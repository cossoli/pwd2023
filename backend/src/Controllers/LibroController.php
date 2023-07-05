<?php
namespace Raiz\Controllers;


use Raiz\Bd\LibroDAO;
use Raiz\Models\Libro;
use Raiz\Bd\AutorDAO;
use Raiz\Bd\CategoriaDAO;
use Raiz\Bd\GeneroDAO;
use Raiz\Bd\EditorialDAO;



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
    
    public static function encontrarUno(string $id): ?array
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
        $parametros['genero'] = GeneroDAO::encontrarUno($parametros['id_genero']);
        $parametros['categoria'] = CategoriaDAO::encontrarUno($parametros['id_categoria']);
        $parametros['editorial']= EditorialDAO::encontrarUno($parametros['id_editorial']);
        foreach($parametros['autor'] as $autor){
            $parametros[$autor][] = AutorDAO::encontrarUno($autor);
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


    public static function borrar(string $id):void
    {
        LibroDAO::borrar($id);
        
    }
    
    


}

