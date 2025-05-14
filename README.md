# Andrei | PDFPHP

Descripción:
------------
PDFPHP es un proyecto desarrollado en PHP que permite generar calendarios y convertirlos en documentos PDF.
El calendario se genera de forma dinámica para un rango de años (por defecto de 2025 a 2050) y permite
navegar entre ellos usando botones para avanzar o retroceder. Además, la aplicación genera un PDF del 
calendario del año seleccionado, posicionando cada mes en una página separada. El diseño es minimalista 
con colores vivos, ofreciendo una experiencia visual clara y moderna.

Características:
----------------
- Generación dinámica de calendarios mensuales para un año determinado.
- Interfaz web para seleccionar el año y navegar entre diferentes años.
- PDF generado (usando Dompdf) en el que cada mes se muestra en una página separada.
- Diseño minimalista y responsivo con colores vivos.
- Gestión de dependencias a través de Composer (incluye Dompdf).
- Estructura modular con clases PHP (CalendarGenerator, PDFGenerator, etc.).

Requisitos:
-----------
- PHP versión 7.2 o superior.
- Composer instalado.
- Servidor web (Apache, Nginx) o uso del servidor PHP embebido.
- (Opcional) wkhtmltopdf para la versión que utiliza Knp\Snappy, aunque por defecto se usa Dompdf.

Instalación:
------------
1. Clona el repositorio en tu entorno de desarrollo.
2. En la raíz del proyecto, ejecuta el siguiente comando para instalar las dependencias:
   
   composer install

3. Configura el proyecto en tu servidor web o utiliza el servidor embebido de PHP, por ejemplo:

   php -S localhost:8000 -t public

4. Verifica que la estructura de carpetas sea la siguiente:
```
   
   andrei-pdfphp/
      ├── composer.json
      ├── composer.lock
      ├── readme.txt
      ├── src/
      │      ├── CalendarGenerator.php
      │      └── PDFGenerator.php
      ├── public/
      │      ├── index.php
      │      ├── calendario.php
      │      ├── pdf.php
      │      └── css/
      │             ├── calendario.css
      │             └── pdf.css
      └── vendor/
             └── (dependencias instaladas por Composer)
```      
Uso:
----
- **Página Principal (index.php):**  
  Accede a `index.php` para visualizar el menú principal, desde donde podrás navegar al calendario o a la
  herramienta de generación de PDF.
  
- **Calendario (calendario.php):**  
  Esta página muestra una lista de años (organizados en dos filas) para seleccionar. Al hacer clic en un año,
  se carga el calendario completo (con navegación entre años a través de flechas) para ese año.

- **Generación de PDF (pdf.php):**  
  A través de un formulario, selecciona el año deseado y pulsa el botón "Generar PDF". Se generará un PDF del
  calendario del año seleccionado, donde cada mes se ubica en una página separada.

Notas:
------
- Si el PDF no se genera correctamente, revisa que los recursos (hojas de estilo, fuentes) se carguen de forma 
  correcta. Se recomienda inyectar estilos inline o usar la etiqueta <base> para que Dompdf resuelva las rutas.
- Puedes personalizar el rango de años y los estilos modificando los archivos correspondientes en `/src/` y `/public/css/`.

Licencia:
---------
Este proyecto se distribuye bajo la licencia MIT.

Autor:
------
Andrei Buga

Contacto:
----------
Para consultas o sugerencias, puedes contactar a Andrei por los medios que prefieras.

---------------------------------------------------------------
¡Gracias por utilizar Andrei | PDFPHP!