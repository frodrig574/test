# test
Instalacion:
base de datos mysql
importar el archivo user.sql, sin crear base de datos.
el archivo ya tiene creada la base de datos completa y el usuario con el cual trabajara la aplicación, solo tienen que importar el archivo sql

el archivo .htacess fue modificado para que no mostrara el index.php asi que hay que configurar el servidor apache si no esta configurado para que funcione la redirección 

aqui se muestra bien lo que se tiene que hacer para configurar el servidor en el caso de linux

https://comunidadcodeigniter.wordpress.com/2009/11/14/caso-url-limpia-de-codeigniter-para-linux-solucionado/

en el caso de windows 

http://georgesystem.com.ve/2015/05/26/como-quitar-o-eliminar-el-index-php-de-las-url-en-el-framework-php-codeigniter-2/

esto se realiza para obtener urls limpias, que ayudan a la optimización del posicionamiento de los buscadores(SEO)

tiene un inicio de session
el usuario es: test@gmail.com
contraseña: 123456

tiene dos CRUD, el de roles y el de usuarios
se deben crear primero los roles, esta validado para no permitir ingresar ningun usuario hasta que este sea creado, al eliminar un rol, eliminara al usuario que tenga ese rol asignado, siempre y cuando el usuario solo tenga ese rol asignado.

las validaciones estan realizadas con html5, libreria de codeinigter from_validation y ajax
el formulario esta realizado con el helper form
se crearon aparte 4 helper, para el header y el footer de la aplicación
y 1 helper para validar el correo, para los casos de modificación del crud de usuario
plantilla realizada con bootstrap y jquery

imagenes editadas y creadas con GIMP(software libre)
la firma KOC, es un proyecto que estoy desarrollando, por si se genera duda, todo el codigo, imagenes y diseño fueron creados por mi persona

la estructura basica de un CRUD, lo modifique, para entretenerme un poco, como fue dicho en la publicidad, se busca pasión por el codigo, y quise demostrar un poco de toda la pasión que tengo.
sin mas que acotar espero les guste...
