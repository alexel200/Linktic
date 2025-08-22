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

el cliente se cargará en el localhost puerto 80, así que para ingresar se debe ingresar en el navegador http://localhost:
```
http://localhost
```

NOTA: Al momento de inicializar los microservicios, se ejecutará automáticamente las migraciones y los seeds que poblaran la base de datos con ejemplos de datos para poder realizar pruebas e interacciones.

### Información de los contenedores:
- product-db: Instancia de mysql, localmente expone el puerto 3306, pero es mapeado en el host en el puerto 33061
- inventory-db: Instancia de mysql que expone el puerto 3306, es mapeado en el puerto 33062
- products-service: Microservicio de productos que expone el puerto 80 localmente y es mapeado en el puerto 9001
- inventory-service: Microservicio de Inventario, expone el puerto 80 y es mapeado en el puerto 9000

Los servidores laravel están corriendo bajo apache, mientras que el front lo hace con nginx.

## Documentación de los endpoints
Para la implementación y documentación de Swagger, se ha utilizado las librerias **zircote/swagger-php** y **darkaonline/l5-swagger**.

<img width="1441" height="691" alt="Image" src="https://github.com/user-attachments/assets/7314d17a-798c-44c5-b728-c64b50317ed1" />
<img width="1452" height="748" alt="Image" src="https://github.com/user-attachments/assets/edae76ea-733a-44ba-b998-4a7c42ce08d6" />


## Imágenes del cliente
El cliente ha sido implementado con una interfaz sencilla con cuatro páginas:
 - Productos: Lista todos los productos que existen en la base de datos 
 - Inventario: Lista todos los productos que se encuentran ingresados en el inventario
 - Ingresar Producto: Permite ingresar un producto al inventario al ingresar el id del producto y la cantidad
 - Simulación de Venta: simula la venta de un item, y lanza el evento de descontar la cantidad vendida en el inventario.

<img width="1899" height="785" alt="Image" src="https://github.com/user-attachments/assets/d1df6c85-021d-431c-a426-14cb2a4a1b1a" />
<img width="1912" height="744" alt="Image" src="https://github.com/user-attachments/assets/fc1f3b6b-f8b7-4cb5-8860-3e009a461ac3" />
<img width="1910" height="817" alt="Image" src="https://github.com/user-attachments/assets/1bbc0bbb-9823-4bf8-b4c3-670e07d5cc90" />
<img width="1896" height="851" alt="Image" src="https://github.com/user-attachments/assets/3f18e622-6f08-4bb5-9127-78d37609d4da" />
<img width="1889" height="784" alt="Image" src="https://github.com/user-attachments/assets/9879348d-1822-4b89-92fa-ab630a9bda2d" />
<img width="1899" height="954" alt="Image" src="https://github.com/user-attachments/assets/867bb06a-215b-4e1b-a986-c416eaea8644" />