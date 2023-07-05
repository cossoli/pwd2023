### Programación Web Dinámica **2023**
## Trabajo Practico N° 5 - MVC
# MODELOS DAO
En este trabajo práctico continuaremos con nuestra aplicacion, en esta oportunidad crearemos los modelos DAO para acceder a nuestra base de datos, los cuales guardaremos en nuestra carpeta Bd

---
Crearemos las siguientes clases:
- SocioDAO
- EditorialDAO
- AutorDAO
- CategoriaDAO 
- GeneroDAO 
- PrestamoDAO

*Todas las clases deben implementae la clase **InterfaceDAO**.
* Para la conexión a la base de datos usar la clase creada para tal fin, la misma es **ConectarBD**
esta clase cuenta con tres métodos estáticos **conectar**, **leer** y **escribir**
El método **leer** es el que utilizaremos para listar todos los registros y buscar por id
El método **escribir** es el que usaremos para insertar, actualizar y eliminar registros.

La clase PrestamoDAO debe modificar el método **crear** para que cuando se persista un nuevo prestamo a la tabla, cambie el estado del libro **(estado = Prestado)**, esto tambien debe suceder cuando el libro es devuelto que debe cambiar a **estado=Activo**.
esta clase no implementa el metodo borrar. debe ser declarado pero vacio o arrojar una excepcion que diga "metodo no implementado"



----
### PARA TENER EN CUENTA

Cuando creamos nuestras tablas en Postgresql existen algunas variaciones en relacion a como se crean con mysql o sqlite, por ejemplo:
Para determinar que el **id** será **auto increment** se utilizará la palabra reservada **serial** que es un tipo de integer con secuencia numérica.

En cuanto a las fechas podremos utilizar varios tipos diferentes pero nos decantaremos por el 
**date** su formato es yyyy/mm/dd, luego con php podremos formatearlo a nuestro sistema horario.

Para los datos como: cantidad de página, teléfono, año usaremos int.

los datos para la conexion a la base de datos estan vinculados atraves de las variables de entorno que definimos en nuestro **.env**, el cual ahora tiene todas las necesarias, lo hacemos de este modo para que todo los datos de la conexión queden protegidos, ademas de que es de mas facil acceso a la hora de tener que cambiar algo.


