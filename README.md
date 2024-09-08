# Proyecto de prueba
### Pasos para levantar el backend
moverse a la ruta del proyecto y posicionarse en el directorio capi-back 

C:\\[ruta del proyecto]\capi-back\

instalar las dependencias del proyecto, haciendo uso del comando 
```sh
composer install
```

posteriormente, tendrá que crear una base de datos mySql con el nombre `capi-back`

En la raiz del proyecto, copiar el archivo `.env.example` y renombrar la copia como `.env`

Ejecutar las migraciones y los seeders

```sh
php artisan migrate
php artisan db:seed
```

Por ultimo, ejecutar el proyecto con
 ```sh
 php artisan serve
 ```

### Pasos para levantar el front

moverse a la ruta del proyecto y posicionarse en el directorio capi-back 

C:\\[ruta del proyecto]\capi-front\

Instalar las dependencias
```sh
npm install
```

levantar el proyecto 

```sh
ng serve
```
