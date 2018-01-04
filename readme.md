## fuentes

CODING CHALLENGE de hackerrank

## instalacion

## clona el repositorio
realiza esto con git

## composer
Ejecutar: composer install

## configuracion de archivo de base de datos
Abre el .env.example y edita esta línea:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=your_username
DB_PASSWORD=your_password

Después de eso , guárdalo como .envarchivo. ¡Esto es importante!

## configuracion de clave
php artisan key:generate

## ejecute el sitio web
Redirige tu servidor XAMPP al directorio público
http://127.0.0.1/cube-summation/public

Si sabes cómo usar Apache, simplemente configúralo. De lo contrario, puede escribir:
php artisan serve

Ejemplo
--------


    Tests: 2
	N Matrix: 4
	N Comandos: 5

	UPDATE 2 2 2 4
	QUERY 1 1 1 3 3 3
	UPDATE 1 1 1 23
	QUERY 2 2 2 4 4 4
	QUERY 1 1 1 3 3 3
