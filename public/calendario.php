<?php
// public/calendario.php

// Activar la visualización de errores (ideal para desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir el autoloader de Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Usar la clase CalendarGenerator (asegúrate de que su namespace es "App" y está en src/)
use App\CalendarGenerator;

// Definir el rango permitido de años
$minYear = 2025;
$maxYear = 2050;

// Verificar si se pasó el año por la URL (por ejemplo: calendario.php?year=2030)
if (isset($_GET['year'])) {
    $selectedYear = (int)$_GET['year'];
    // Validar que el año esté dentro del rango; si no, asignar el mínimo.
    if ($selectedYear < $minYear || $selectedYear > $maxYear) {
        $selectedYear = $minYear;
    }
} else {
    // Si no se selecciona ningún año, se deja nulo para mostrar la lista de años.
    $selectedYear = null;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calendario</title>
    <link rel="stylesheet" href="css/calendario.css">
</head>
<body>
    <header>
        <h1>Calendario</h1>
    </header>
    
    <nav class="year-selection">
        <?php if ($selectedYear === null): ?>
            <h2>Selecciona un año</h2>
            <ul>
                <?php for ($year = $minYear; $year <= $maxYear; $year++): ?>
                    <li><a href="calendario.php?year=<?php echo $year; ?>"><?php echo $year; ?></a></li>
                <?php endfor; ?>
            </ul>
        <?php else: ?>
            <h2>Año: <?php echo $selectedYear; ?></h2>
        <?php endif; ?>
    </nav>
    
    <main>
        <?php if ($selectedYear !== null): ?>
            <div class="calendar-year">
                <?php
                // Generar y mostrar el calendario de los 12 meses para el año seleccionado
                for ($month = 1; $month <= 12; $month++) {
                    echo CalendarGenerator::generateCalendar($selectedYear, $month);
                }
                ?>
            </div>
        <?php endif; ?>
    </main>
    
    <?php if ($selectedYear !== null): ?>
    <footer class="navigation-arrows">
        <div class="nav-buttons">
            <?php if ($selectedYear > $minYear): ?>
                <a class="nav-arrow prev" href="calendario.php?year=<?php echo $selectedYear - 1; ?>">&laquo; Año anterior</a>
            <?php endif; ?>
            
            <?php if ($selectedYear < $maxYear): ?>
                <a class="nav-arrow next" href="calendario.php?year=<?php echo $selectedYear + 1; ?>">Año siguiente &raquo;</a>
            <?php endif; ?>
        </div>
        <!-- Botón extra para volver a la página de inicio -->
        <div class="back-to-index">
            <a class="nav-arrow back" href="index.php">Volver a Inicio</a>
        </div>
    </footer>
    <?php endif; ?>
</body>
</html>