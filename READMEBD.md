## PROCEDIMIENTO PARA CREAR UNA BASE DE DATOS ##

## Primero que nada importante ya tener una base de datos creada, en este caso la estoy creando con phpMyAdmin en lugar de mysql por ejemplo

## Luego ejecutamos en la consola php artisan migrate para que se ejecute la migracion y se creen las tablas que deseamos, hay que tener CUIDADO con esto, porque literalmente hace cambios en la base de datos, cosa que nos puede traer problemas

## NOTA: Hay un error que tengo que revisar en las migraciones,  cuando las ejecuto se crea la tabla de migracione y la tabla de usuarios, con los datos que le ponga en el Schema, pero las demas migraciones con tablas no se crean y sale un error en la terminal

