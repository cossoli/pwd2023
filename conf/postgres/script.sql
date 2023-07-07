
CREATE TABLE public.autores (
	id serial4 NOT NULL,
	nombre_apellido varchar NULL,
	CONSTRAINT autores_pkey PRIMARY KEY (id)
);


CREATE TABLE public.autores_libros (
	id serial4 NOT NULL,
	id_autor int4 NOT NULL,
	id_libro int4 NOT NULL
);


CREATE TABLE public.categorias (
	id serial4 NOT NULL,
	descripcion varchar NULL,
	CONSTRAINT categorias_pkey PRIMARY KEY (id)
);

CREATE TABLE public.editoriales (
	id serial4 NOT NULL,
	nombre varchar NULL,
	CONSTRAINT editoriales_pkey PRIMARY KEY (id)
);

CREATE TABLE public.generos (
	id serial4 NOT NULL,
	descripcion varchar NULL,
	CONSTRAINT generos_pkey PRIMARY KEY (id)
);

CREATE TABLE public.socios (
	id serial4 NOT NULL,
	nombre_apellido varchar(50) NOT NULL,
	fecha_alta date NOT NULL,
	activo int4 NOT NULL,
	direccion varchar(100) NOT NULL,
	telefono int4 NULL,
	CONSTRAINT pk_socios PRIMARY KEY (id)
);


CREATE TABLE public.libros (
	id serial4 NOT NULL,
	titulo varchar NOT NULL,
	id_genero int4 NOT NULL,
	id_categoria int4 NOT NULL,
	cant_paginas int4 NOT NULL,
	anio int4 NULL,
	estado varchar NOT NULL,
	id_editorial int4 NULL,
	CONSTRAINT pk_libnos PRIMARY KEY (id),
	CONSTRAINT fk_categoria FOREIGN KEY (id_categoria) REFERENCES public.categorias(id),
	CONSTRAINT fk_editorial FOREIGN KEY (id_editorial) REFERENCES public.editoriales(id),
	CONSTRAINT fk_genero FOREIGN KEY (id_genero) REFERENCES public.generos(id)
);

CREATE TABLE public.prestamos (
	id serial4 NOT NULL,
	id_libro int4 NOT NULL,
	id_socio int4 NOT NULL,
	fecha_desde date NULL,
	fecha_hasta date NULL,
	fecha_dev date NULL,
	CONSTRAINT fk_socio FOREIGN KEY (id_socio) REFERENCES public.socios(id),
	CONSTRAINT prestamos_fk FOREIGN KEY (id_libro) REFERENCES public.libros(id)
);


CREATE SEQUENCE public.autores_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.autores_libros_id_seq;

CREATE SEQUENCE public.autores_libros_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.categorias_id_seq;

CREATE SEQUENCE public.categorias_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.editoriales_id_seq;

CREATE SEQUENCE public.editoriales_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.generos_id_seq;

CREATE SEQUENCE public.generos_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.libros_id_seq;

CREATE SEQUENCE public.libros_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.prestamos_id_seq;

CREATE SEQUENCE public.prestamos_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.socios_id_seq;

CREATE SEQUENCE public.socios_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;-- public.autores definition
