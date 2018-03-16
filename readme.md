#Guía para descargar y desplegar el proyecto de frases célebres de Chuck Norris

#Para descargar el proyecto
git clone https://github.com/manucm/ChuckPhrases.git

#Descargar las dependencias del Proyecto
composer install

#Generar una key para el proyecto
php artisan key:generate

#Completar el .env
JOKE_NUMBERS=x
#donde x es el número de registros que se quiere introducir en la BD.
#los datos de frases célebres se obtendrán de una api externa https://api.chucknorris.io

#Para la BD yo he optado por MySQL pero bien se podría usar PostgresQL, SQL Server,..
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=interhanse
DB_USERNAME=chucknorris
DB_PASSWORD=chucknorris
#Para usar esta configuración habría que crear en mysql una base de datos con nombre interhanse 
#y un usuario con username y password chucknorris que tenga permisos sobre dicha BD

#Ejecutar las migraciones y el seed de datos
php artisan migrate install --seed

//Generar el bundle de javascript y el css a partir de sass
npm run dev

#Con todos ellos se podrá logar y administrar la app
El proyecto se ha desarrollado con la versión 5.5.0 de Laravel

#En el archivo hosts que se encuentra en la ruta 
C:\Windows\System32\drivers\etc (Window)
/etc/hosts (MACOSX y linux)

#Se añade la siguiente línea:
127.0.0.1			www.nombre_host.es

#Como servidor web he usado Apache
por tanto en la carpeta de configuración:
C:\laragon\etc\apache2\sites-enabled

Se añade un fichero de configuración 
nombre.conf

y se agrega la siguiente configuración:
<VirtualHost _default_:80>
   ServerName www.interhanse.es 
   ServerAlias www.interhanse.es 
   DocumentRoot C:\laragon\www\interhanse-test\public
   <Directory "C:\laragon\www\interhanse-test\public"> 
       AllowOverride All
       Require all granted
   </Directory>
</VirtualHost>

//Con el seed se generan dos usuarios con los que nos podemos logar en la aplicación
username: System, interhanse
password: secret para ambos
//Además se genrean otros 3 "Fake usuarios"
username: se genera de forma aleatoria
password: secret
