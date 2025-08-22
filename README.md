# Prueba Técnica 

Autor: Jhon Alexander Rueda Sánchez  
email: alexel200@gmail.com  

La implementación se realiza con arquitectura hexagonal en laravel, tanto para el microservicio de productos (products), como para el de inventarios(Inventory). El front esta hecho en Vue.

Para el desarrollo de esta prueba, se implementa la base de datos mysql, para simular un entorno real, donde cada microservicio tiene su propia base de datos. También para realizar toda la implementación con docker. Cómo se puede apreciar, todos los componentes del sistema estan dockerizados.

## Ejecución
Para correr el sistema, basta con ejecutar el siguiente comando en la raíz del proyecto:
````
docker compose up
````
Este comando descargará y lanzará los contenedores necesarios. Por lo tanto, es indispensable tener instalado docker para poder correr esta plataforma.

NOTA: Al momento de inicializar los microservicios, se ejecutará automáticamente las migraciones y los seeds que poblaran la base de datos con ejemplos de datos para poder realizar pruebas e interacciones.

## Documentación de los endpoints
Para la implementación y documentación de Swagger, se ha utilizado las librerias **zircote/swagger-php** y **darkaonline/l5-swagger**.

