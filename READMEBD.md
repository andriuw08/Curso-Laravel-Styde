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

## Los modelos se crean con el comando php artisan make:model Profession. Los modelos son para trabajar con los seeders, solo que en lugar de trabajar con las consultas normales trabaja con los modelos, lo que es mejor ya que es en un mas alto nivel y nos rellena los campos de created_at y updated_at

## IMPORTANTE, en el seeder de user si utilizamos el orm para obtener el valor de la llave foranea, es importante saber que el metodo WHERE no existe, pero el eloquent tiene algo llamado 'METODOS MAGICOS' los cuales a pesar de no encontrar un metodo en laravel llama a al metdo call

## Tinker es un entorno de programacion desde la misma terminal, para acceder al entorno es con php artisan tinker. IMPORTANTE -> Si estoy usando Tinker y quiero utilizar alguno de los modelos para hacer consultas, pruebas, agregar registros y cosas asi, tengo que importar el modelo con use App\Models\Profession, una vez hecho esto ya podriamos utiliizar el modelo por su nombre.

## En tinker hay un error llamado MassAssignmentException, el cual para solucionarlo debemos hace lo siguiente -> En el modelo de la tabla la cual estamos queriendo crear valores, le debemos de coloca el siguiente codigo adentro del modelo protected $fillable = ['title']; esto para poder permitir la asignacion masiva de valores.

## En eloquent y tinker podemos hacer cualquier tipo de consulta, creacion, visualizacion, edicion, eliminacion, obtener, todas las consultas sql las podemos hacer desde la terminal con tinker.

## Los model factories permiten crear registros de prueba o para ejecutar pruebas unitarias, para poder acceder a los model factories tenems que utilizar tinker, luego desde tinker ejecutando el comando factory(User::class)->create(); IMPORTANTE-> Lo que esta en el parentesis es el modelo el cual queremos relacionar.

## Desde los seeders tambien podemos utilizar el factory, esto para poder generar muchos registros fakes de manera mas rapida, esto con el fin de realizar pruebas, pes una de las multiples maneras de general muchos registros. 

## =========================================================##

## Uso de los test

## Los test los encontramos en la carpeta test/feature, estos test sirven para probar las rutas, que se reciban bien y que devuelvan lo que tienen que devoler, estas rutas estan en el archivo routes/web, y estas rutas se suponen deberian de utilizar un controlador el cual se encuentran en app/http/controllers. Estos test sirven para que antes de hacer cualquier cambio en la base de datos o cualquier cambio importante comprobemos que los cambios previos a estos esten bien,ya que si hacemos un cambio y ya los test no pasan es una manera de comprobar en donde esta el error

## IMPORTANTE -> la manera de correr estos test es con el codio vendor/bin/phpunit en la terminal

## IMPORTANTE -> Hay que implementar el uso de controladores ya que tener tanto codigo en las rutas no esta bien, ni visualmete ni funcionalmente

## Con el uso de factory podemos crear muchos registros falsos en nuestros seeders mejorar las pruebas


## =============================================================================##

## Uso de blade

## Realmente blade no es dificil de aprender, es como vue pero con sentencias un poco diferentes, estas son maneras diferentes de trabajar con un valor en blade, lo tenia en la misma plantilla pero da error a pesar de estar comentado
##  ESTA ES LA MANERA DE HACERLO CON PHP NATIVO 
##    <ul>
##        De esta manera recorremos el arreglo de usuarios que hemos creado en las rutas, para asi poder mostrarlo en la vista como una lista
##        <?php foreach($users as $user): ?>
##            <li> <?php echo e($user) ?> </li>
##            el metodo e es muy importante para que php ignore el codigo html o js que pueda llegar a estar en el arreglo, esto con el fin de que si alguien llega a crear un usuario con codigo js o html se muestre como un string
##        <?php endforeach ?>
##    </ul> -->
##    TAMBIEN SE PUEDE USAR UN UNLESS EN LUGAR DE UN CONDICIONAL
##            El unless funciona como un condicional pero inversio, es decir, "A menos que la lista de usuarios este vacia, mostrare el listado de usuarios, sino el arreglo de usuarios"
##    @unless(empty($users))
##        <ul>
##            @foreach($users as $user)
##                <li> {{ $user }} </li>
##            @endforeach        
##        </ul>
##    @else
##        <p> No hay usuarios registrados </p>
##    @endunless   -->
##
##    TAMBIEN SE PUEDE USAR UN EMPTY EN LUGAR DE UN CONDICIONAL
##            El empty se usa para verificar si una variable esta vacia
##    @empty($users)
##        <p> No hay usuarios registrados </p>
##        @else
##        <ul>
##            @foreach($users as $user)
##                <li> {{ $user }} </li>
##            @endforeach        
##        </ul>
##    @endempty   -->


