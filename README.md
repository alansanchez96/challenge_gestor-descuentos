# Laravel / PHP / MySQL
#### Challenge V4

##### [ABM] Descuentos en rentas de vehiculos 

**Despliegue Local**
- **Version**: Laravel v9.48.0 (PHP v8.1.12)
- **Requisitos**: Tener instalado la version de PHP 8.0.2^ | Composer | Npm | GIT | MySQL

- Descargue el repositorio en su maquina local:

```bash
	$ git clone git@github.com:alansanchez96/challenge_gestor-descuentos.git
```
- Abra su terminal preferida en la raiz del proyecto y ejecute para instalar las dependencias:

```bash
	$ composer install && npm install
```

- Cree un nuevo archivo **.env** en la raiz del proyecto duplicando el contenido de **.env.example** y configure su base de datos

- Abra nuevamente su terminal y ejecute las migraciones:

```bash
	$ php artisan key:generate && php artisan migrate --seed
```

- Para iniciar el servidor local ejecute en 2 terminales distintas:

```bash
	$ php artisan serve
```

```bash
	$ npm run dev
```

• Autentifiquese con las siguientes credenciales

`Usuario: admin@example.com`
`Password: password`

**Nota**: Tambien viene responsive
### Imagenes del proyecto

##### Listado

[![Listado](https://i.ibb.co/RNpXvTK/Screenshot-2023-08-31-at-22-34-27-Laravel.png "Listado")](https://i.ibb.co/RNpXvTK/Screenshot-2023-08-31-at-22-34-27-Laravel.png "Listado")

##### Formulario
[![Formulario](https://i.ibb.co/GCJtY2c/Screenshot-2023-08-31-at-22-34-46-Laravel.png "Formulario")](https://i.ibb.co/GCJtY2c/Screenshot-2023-08-31-at-22-34-46-Laravel.png "Formulario")

##### Validaciones
[![Formulario_2](https://i.ibb.co/ssTSwYh/Screenshot-2023-08-31-at-22-35-00-Laravel.png "Formulario_2")](https://i.ibb.co/ssTSwYh/Screenshot-2023-08-31-at-22-35-00-Laravel.png "Formulario_2")