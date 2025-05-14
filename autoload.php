<?php
/**
 * Autoloader simple para el proyecto.
 * 
 * Este archivo implementa un autoloader PSR-4 para cargar clases bajo el namespace "App\"
 * localizadas en el directorio "src/".
 * 
 * Guarda este archivo en la raíz de tu proyecto y, en tus puntos de entrada (por ejemplo, en public/index.php),
 * inclúyelo de la siguiente manera:
 *
 *     require_once __DIR__ . '/../autoload.php';
 */

// Registrar la función autoload.
spl_autoload_register(function ($class) {
    // Define el prefijo que usaremos para nuestro namespace.
    $prefix = 'App\\';

    // Directorio base donde se ubican las clases.
    $base_dir = __DIR__ . '/src/';

    // Verifica si la clase utiliza el prefijo especificado.
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // La clase no utiliza el namespace "App\", se omite.
        return;
    }

    // Obtiene la parte relativa del nombre de la clase, es decir, sin el prefijo.
    $relative_class = substr($class, $len);

    // Reemplaza los separadores de namespace por separadores de directorio en la parte relativa
    // y añade la extensión .php.
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Si el archivo existe, lo carga.
    if (file_exists($file)) {
        require $file;
    }
});