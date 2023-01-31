# Laravel / PHP / MySQL
#### Challenge

El objetivo de este desafío consiste en la realización de un gestor (ABM) de Descuentos de una plataforma de renta de vehículos.
Para realizar esta tarea, junto a este documento se entregan:
- El archivo database_ddl.sql, con las sentencias sql de creación de las tablas necesarias para este ejercicio.
- El archivo database_data.sql, con datos para algunas tablas, como brands y regions.
- 2 capturas de pantalla, (list.png y form.png), para tomarse como referncia y guía.

[Descarga .RAR por Google Drive](https://goo.su/XLDAt "Descarga .RAR por Google Drive")

### La funcionalidad a desarrollar es la siguiente
Este ABM permite gestionar los descuentos que otorga el sistema cada vez que se realiza la renta de un vehículo.
El descuento, se define por:
- Tipo de acceso al sistema (si es cliente final, agencia o corporativo).
- Por la marca de la rentadora (Avis, Budget, Payless)
- Por la región donde realiza el alquiler del vehículo.
- Los descuentos se pueden definir en función de un código (AWD) que es un dato interno del sistema, conocido por el que carga el descuento, o directamente por un porcentaje de descuento... o por una combinación de ambos.
- Los descuentos se definen según la cantidad de días de alquiler.
Por ejemplo:
	- Entre 1 y 15 días, aplicando el código C12345
	- Entre 16 y 25 días, aplicando un descuento de 5%
	- Entre 26 y 59 días, una combinación del código C12345 y 5 %.
- Se pueden definir hasta 3 rangos de días, con sus respectivos descuentos

**Login de usuario.**
- Debe requerir el login de un usuario. Estos usuarios deben estar precargados en la
base del sistema, o sea, no es necesario realizar el proceso de alta.
- Si el login es exitoso, pasar directamente al Listado de Descuentos.
- Si el login es fallido, mostrar error y mantenerse en la pantalla de login
- Usuario a utilizar :
	- **Usuario**: admin@example.com
	- **Clave**: password.

**Formulario de Alta y Edición de Descuentos (form.png)**
- Se deben validar los datos y su completitud.
- Nombre de la regla ( *discounts.name* ) :
	- Alfanumérico, obligatorio.
	- No se puede repetir en la tabla.
	- Validar tamaño del dato ingresado.
- Activa / Inactiva ( *discounts.active* ):
	- 1 = activa / 0 = inactiva
	- Por default inactiva.
- Rentadora ( *discounts.brand_id* ):
	- Obligatorio
	- Sale de la tabla brands.
	- Debe presentar el listado de Marcas.
	- Debe mostrar sólo las marcas activas (brands.active = 1)
	- El listado debe mostrarse ordenado según la columna display_order.
- Tipo de acceso ( *discounts.access_type_code* ):
	- Obligatorio
	- Sale de la tabla access_types
	- Debe presentar el listado de tipos de acceso.
	- El listado debe mostrarse ordenado según la columna display_order.
- Prioridad ( *discounts.priority* ):
	- Numérico, obligatorio, default 0.
	- Se puede repetir.
	- Rango válido 1 a 1000
- Región ( *discounts.region_id* ):
	- Obligatorio
	- Sale de la tabla: regions
	- Debe presentar el listado de Regiones
	- El listado debe mostrarse ordenado según la columna display_order.
- Períodos de Aplicación
	- Se presentan sólo 3 períodos de aplicación.
	- En el alta, se presentan los campos del primer período habilitados y al completarse se habilita el segundo... y luego de completado este se habilita el siguiente.
	- Campos:
		- Desde y hasta:
			- Numericos, obligatorios.
			- "Desde" debe ser menor que "Hasta"
			- No es necesario validar que los rangos de días sean consecutivos o que se solapen.
		- Código de Descuento AWD:
			- Alfanumérico, opcional.
		- Porcentaje de Descuento GSA:
			- Numérico, opcional.
			- Uno de los 2 (código o porcentaje) debe estar completo.
			- Pueden estar los 2.
			- Pero no pueden estar los 2 vacíos.
- Período de aplicación ( *rango de fechas* ):
	- Obligatorio
	- Corresponde a los campos discounts. *start_date* y *end_date*
	- Puede implementarse como 2 campos separados con datepicker

**Listado de Descuentos (list.png)**
- Debe implementar paginado, filtro y ordenamiento.
- Tener en cuenta que el listado, debe presentar los registros correspondientes a las rentadoras activas únicamente ( *brands.active == 1* )
- El listado debe presentarse desde el momento en que se presenta la pantalla, con un ordenamiento predeterminado ( *discounts.name* ).
- Datos a mostrar, y su correspondiente origen:
	- Rentadora: brands.name
	- Región: regions.name
	- Nombre: discounts.name
	- Tipo de Acceso: access_types.name
	- Estado: discounts.active (1 = activo / 0 = inactivo )
	- Período: registros de discount_ranages: from_days - to_days
	- AWD/BCD: registros de discount_ranges: code
	- Descuento GSA: registros de discount_ranges: discount
	- Período de Promoción: discounts start_date - end_date
	- Prioridad: discounts.priority
- Tener en cuenta, de las capturas de pantalla, la forma en que se muestran los
valores de las columnas (formato de fechas, números y el alineamiento).
- FIltros del listado:
	- Rentadora
		- Debe presentar la lista de Rentadoras (brands)
		- Debe mostrar sólo las marcas activas (brands.active = 1)
		- El listado debe mostrarse ordenado según la columna display_order.
	- Región
		- Debe presentar el listado de Regiones
		- El listado debe mostrarse ordenado según la columna display_order.
	- Nombre (alfanumerico)
	- Debe buscar este dato en la columna discounts.name (aplicando like)
	- AWD/BCD
		- Debe buscar este dato en la columna discount_ranges.code (debe ser exacto)
	- El filtro debe aplicarse en el momento de presionar “Buscar”
- Exportación de datos
	- Debe descargar un archivo csv, con las mismas columnas del listado, de todos los registros aplicando el filtrado.
	- El nombre del archivo es fijo: descuentos.csv

**Borrado de descuentos**
- En el listado de descuentos, se presenta en cada fila un botón para el borrado de descuentos. El borrado debe ser lógico (soft delete).
- Puede presentarse un modal estándar para confirmar el borrado. (Puede hacerse con un confirm() de javascript)

**Entregable**
- Para el login de usuarios, puede utilizarse el método estándar que incluye Laravel.
- El proyecto incluir como mínimo:
	- Las migraciones de todas las tablas.
	- Seeder para
		- La tabla de usuarios (con el usuario indicado más arriba),
		- Las tablas de referencia de las que se entregaron los scripts (inserts)
		- Un set de pruebas, de entre 15 y 30 registros de descuentos.

**Consideraciones generales**
- Las páginas pueden resolverse con Bootstrap y Livewire, u otro framework.
- No se pueden utilizar frameworks como React, Angular, Vue.
- El desarrollo de la funcionalidad de Exportación es opcional. Puede utilizarse algún paquete de PHP, como maatwebsite/excel
- El paginado, el filtro y el ordenamiento, deben resolverse del lado del controlador, no por javascript.
- Puntos que serán evaluados:
	- Resolución general de las funcionalidades.
	- Organización y prolijidad del código.
	- Descripción del proceso de despliegue.

**Despliegue Local**
- **Version**: Laravel v9.48.0 (PHP v8.1.12)
- **Requisitos**: Tener instalado la version de PHP 8.0.2^ | Composer | Npm | GIT | MySQL

- Descargue el repositorio en su maquina local:

```bash
git clone https://github.com/alansanchez96/green-flame_test.git
```
- Abra su terminal preferida en la raiz del proyecto y ejecute:

```bash
npm install
composer install
```

- Cree un nuevo archivo **.env** en la raiz del proyecto duplicando el contenido de **.env.example** y configure su base de datos

- Abra nuevamente su terminal y ejecute las migraciones:

```bash
php artisan migrate --seed
php artisan generate:key
```

- Para iniciar el servidor local ejecute en su terminal en la raiz del proyecto:

```bash
php artisan serve
npm run dev
```

• Autentifiquese con las siguientes credenciales

`Usuario: admin@example.com`
`Password: password`

###Imagenes del proyecto

#####Listado

[![Listado](https://i.ibb.co/GpKHsVb/Screenshot-2023-01-31-at-16-17-55-Laravel.png "Listado")](https://i.ibb.co/GpKHsVb/Screenshot-2023-01-31-at-16-17-55-Laravel.png "Listado")

#####Formulario
[![Formulario](https://i.ibb.co/2gpVXQc/Screenshot-2023-01-31-at-16-22-51-Laravel.png "Formulario")](https://i.ibb.co/2gpVXQc/Screenshot-2023-01-31-at-16-22-51-Laravel.png "Formulario")