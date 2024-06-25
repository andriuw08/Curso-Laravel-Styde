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

## Lo mas recomendable cuando hacemos test es tener dos bases de datos, una con los datos normales y una para hacer test, esto debido a que si tenemos un test que necesitamos que cree datos especificos o que borre una tabla para comprobar cuando este vacio esto nos puede generar probelmas con los datos reales y con los seeders

## Para hacer test mas automaticos y esecificos a la base de datos utilizamos una linea de codigo use RefreshDatabase; El problema con esto es que limpia las bases de datos y las vuelve a llenar utilizando el migrate y el seeder, cosa que como mencione anteriormente me daria error ya que no puedo utilizar los migrates, una vez solucione el problema que tengo con ello podre utilizar este comando.

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

## ====================================================================##

## Manejo de errores

## En nuestras rutas, con el codigo $user = User::findOrFail($id); validamos si existe o no el id en el arreglo de usuarios, caso de que no nos va  allevar a una especificamente creada para el manejo de errores 404, para personalizar esta pagina lo podemos hacer creando una ista con el nombre 404.blade.php obligatoriamente, en una carpera del estilo views/errors/404.blade.php

## Cuando queremos hacer una peticion post muchas veces laravel las protege, dependiendo de la version de laravel podemo arreglar comentando la linea de codigo \App\Http\Middleware\VerifyCsrfToken::class, en el kernel.php de la carpeta http, o en otras versiones de laravel con la linea de codigo { !! csrf_field() !! } en el formulario que hace la peticion

## SOLUCION DEL ERROR { !! csrf_field() !! } -> en otras versiones en lugar de usarlo asi se usa @csrf

## IMPORTANTE, es necesario dejar esa linea de codigo activada y hacerlo generando un token, ya que esto es lo que nos protege ante ataques de tipo post.

## ===================================================================================================== ##

## Barra de debug de laravel

## Para poder encontrar esta barra desde la terminal tenemos que ejecutar el siguiente comando en la terminal -> composer require barryvdh/laravel-debugbar –dev

## ===================================================================================================== ##

## Paginacion con laravel

## En el controlador: cuando se obtienen los resultados del modelo añadir la propiedad “paginate”: $productos = Producto::paginate(3);

## En la vista: añadir la siguiente linea para pintar la paginación (es totalmente compatible con Bootstrap): {{ $productos->links() }}

## =====================================================================================##



























## NOTAS IMPORTANTES
 
 ## Los problemas que he ido comentando a lo largo del curso se debe a la version de laravel, lastimosamente el curoso que estoy haciendo tiene una version de laravel de 5, mientras que en mi entorno de desarrollo uso la version 8, lo cual me genera ciertos problemas, algunos ya he ido solucionando poco a poco y otros como son el caso de los migrates, factories y RefreshDataBase los he ido dejando para despues, ya que solo con cambiar la sintaxis a la version actualizada deberia de ser mas que suficiente. 

 ## El Plugin laravelcollective esta muy interesante, sobretodo para hacer formularios, trae de una vez validaciones para los campos lo que nos va a facilitar un monton muchas cosas, entre ellas tener formularios seguros.

## El metodo trans() esta bastante interesante, sirve para poder traducir cosas de manera automatica, sin embargo es importante tener en cuenta que para que la traduccion se haga bien tenemos que tener los textos en el archivo config/app.php en el directorio resource/lang{locale}.   --> echo trans('messages.welcome');

## Asi como hay un metodo para encriptar una contraseña siendo este encrypt, tambien hay uno para desencriptar, siendo decrypt, en ambos pasando como parametro el valor o la variable de la contraseña

## Hay un framework de larravel para poder diseñor la interfaz mas facil y eficiente, nosotros utilizamos bootstrap pero para cualquier cosa ese framework creo que tambien se podria utilizar

## Hay una libreria que nos permite generar un pdf a partir de un html, suena bastante interesante se llama dompdf\dompdf 

## Con laravel replicate podemos duplicar un registro de una tabla, es importante mencionar que podemos editar campos especificos de este registro. 

## Hay un error al parecer bastante comun el cual es Allowe memory size of, en caso de recibir ete error lo podemos resolver con las instrucciones que estan en este link https://www.viavox.com/wiki/doku.php?id=devops:documentacion:tecnologias:laravel:phpunit#phpunit_-_fatal_errorallowed_memory_size_of

## La mejor manera de crear funcionalidades para fechas es utilizando carbon, https://carbon.nesbot.com/docs/, tiene varias funcionalidades que nos pueden ayudar bastante para crear un buen componente de fechas

## Swagger nos puede ayudar mucho a todo lo que tenga que ver con las apisRest

## Los helpers son algo asi como los componentes, son funciones que definimos en el archivo de Helpers.php las cuales podemos llamar en varias partes de nuestro codigo, evitando asi que estemos duplicando codigo y que se puedan mantener de forma mas facil todas aquellas funciones que se ejecutan en varias partes de nuestro codigo pero hacen exactamente lo mismo

## En laravel la manera correcta de declarar una constante es de el archivo config/constants.php, aca tenemos que declararlas en tipo array y con una estructura de un archivo de configuraciones para que esta constante pueda ser accesible desde cualquier parte de nuestro proyecto, return [
##                                                                    'options' => [
##                                                                        'type_employed' => array (
##                                                                            'Docente'       => 'Docente',
##                                                                            'No docente'    => 'No docente'
##                                                                        )
##                                                                    ]
##                                                                ]

## Los observer sirven para no sobrecargar nuestro controlador de modelos, sino para que mientras que con los controladores se encarguen de obtener y devolver los observer hagan lo demas, generando asi un codigo facil de mantener

## Los logs en laravel son un registro de los eventos que suceden en la aplicacion, es muy importante para poder localizar y resolver poblemas de la aplicacion de forma rapida y eficiente, sin embargo es un tema que hay que darle una buena vuelta ya que lo ideal seria crear o personalizar nuestro propios logs para asi obtener lo que neesitemos

## Para las migraciones es importante saber que tienen un valor por defecto definido, lo cual es lo que nos generaba error en el proyecto con las migraciones, la manera de definir el valor es en el appProvider colocar Schema::defaultStringLength(Builder::$defaultStringLength); adentro de la funcion boot, el cual viene por defecto en 255.

## Laravel Dusk es un entorno de pruebas locales desde el navegador, es una buena idea para probar un producto antes de ser entregado ya que simula la navegacion de un usuario en la aplicacion

## Un proyecto multi Tenant se refiere a cuando tiene diferentes usuarios y por lo tanto diferentes funcionalidades en modulos pero siendo el mismo proyecto, es decir, una web de vendedores y consumidores, si se maneja todo desde una sola web y lo unico que cambia son los permisos que tiene cada usuario, eso seria una web multi tenant 

## A partir de laravel 6 hay un chat en tiempo real,  lo cual permite que las actualizaciones se actualicen en tiempo real, como si fuese live srrver pero nativo, aca hay un guia de como implementarlo tanto en el back como en el front https://www.viavox.com/wiki/doku.php?id=devops:documentacion:tecnologias:laravel:chat

## MUY IMPORTANTE!!!!!!! en este link https://www.viavox.com/wiki/doku.php?id=devops:documentacion:tecnologias:laravel:cp ---------- Se explica acerca de la estructura que utiliza la empresa, de tener los tres proeyctos diferentes, el CP, Api y vist aen caso de tener, es muy importante tener esto presente para que en el momento en que me toque desarrollar yo solo algo no me pierda tanto y sepa por lo menos que es y para que sirve cada una de las cosas 

## Hay maneras de conectarse a la base de datos de zoom en caso de ser necesario, en este link se explcia de manera detalladad como conectarse y consumirla  https://www.viavox.com/wiki/doku.php?id=devops:documentacion:tecnologias:laravel:zoom

## Si queremos insertar adentro de una aplicacion ya existente nuestra alicacion laravel, se puede hacer con la informacion que sale en este link https://www.viavox.com/wiki/doku.php?id=devops:documentacion:tecnologias:laravel:iframe

## En caso de que necesitemos obtener un archivo excel a partir de un modelo, lo podemos hacer con la informacion que sale en este link https://www.viavox.com/wiki/doku.php?id=devops:documentacion:tecnologias:laravel:excel

## En caso de que queramos hacer una aplicacion con permisos, cosa que es lo mas probable porque casi todas las apicaciones necesitan roles y permisos, lo hacemos desde los mismos controladores con siguiendo este ejemplo https://www.viavox.com/wiki/doku.php?id=devops:documentacion:tecnologias:laravel:auth-gate1 y https://www.viavox.com/wiki/doku.php?id=devops:documentacion:tecnologias:laravel:auth-gate2

## A partir de laravel 7 cambiaron un par de cosas, una de ellas que esta bastant interesante es la implementacion de funciones para eliminar espacios en blanco, cambias mayus o minus, reemplazo y etc, algunas no son nuevas pero han sido refactorizadas, aca se pueden ver algunas de ellas https://www.viavox.com/wiki/doku.php?id=devops:documentacion:tecnologias:laravel:laravel7

## Hay un plugin de laravel que es una adaptacion de un plugin de jquery, con el cual podemos generar y utilizar la barra de aceptacion de coockies, esto esta muy bueno para implementar en un proyecto que de pronto sea un poco mas grande y mas serio en el cual tengamos que implementar una buena logica de negocio, aca hay una explicacion y ejemplos de como poder implementarlo y darle uso https://www.viavox.com/wiki/doku.php?id=devops:documentacion:tecnologias:laravel:cookies

## ================================================== I M P O R T A N T ================================ ##

## Hasta este punto ya he terminado el curso, completo, lo que queda seria solo practicar y hacer proyectos de practica

