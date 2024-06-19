## PROCEDIMIENTO PARA CREAR UNA BASE DE DATOS ##

## Primero que nada importante ya tener una base de datos creada, en este caso la estoy creando con phpMyAdmin en lugar de mysql por ejemplo

## Luego ejecutamos en la consola php artisan migrate para que se ejecute la migracion y se creen las tablas que deseamos, hay que tener CUIDADO con esto, porque literalmente hace cambios en la base de datos, cosa que nos puede traer problemas

## NOTA: Hay un error que tengo que revisar en las migraciones,  cuando las ejecuto se crea la tabla de migracione y la tabla de usuarios, con los datos que le ponga en el Schema, pero las demas migraciones con tablas no se crean y sale un error en la terminal

## Para crear una nueva migracion es con php artisan make:migration nombre_de_la_migracion_bien_descriptivo

## Estos son los errores que me da cuando trato de ejecutar las migraciones 

## Hay diferentes metodos que se pueden hacer con el migrate, entre ellos esta migrate:reset -> Nos dira en orden de mas nuevo a mas viejo las migraciones que se han ejecutado. migrate:refresh -> va a ejecutar de nuevo todas las migraciones, haciendo primero un reset para que las vuelva a ejecutar a pesar de ya haberse ejecutado una vez. migrate:rollback -> va a revertir todos los cambios hechos por la ultima migracion. migrate:fresh -> elimina todas las tablas de la base de datos y vuelve a ejecutar todas las migraciones una por una, Esto solo se puede hacer en un entorno de produccion

## IMPORTANTE: Con el error que mencione anteriormente solo se crea una de las migraciones, siendo esta la de la tabla de usuarios, de ahi no pasa por el error que sale

## Con los seeders creamos los datos para llenar las tablas, para crear los seeders se hace ejecutando el comando php artisan make:seeder. Una vez creado el seeder, lo llamamos en el DataBaseSeeder y ejecutamos el comando php artisan db:seed para que se ejecute 

## En los seeders, con el uso de insert podemos colocar codigo sql directamente de esta manera -> DB::insert('INSERT INTO professions (title) VALUES ("Desarrollador back-end")');