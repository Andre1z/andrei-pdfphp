<?php
// public/pdf.php

// Activar la visualización de errores para desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir el autoloader de Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Usar las clases necesarias
use Dompdf\Dompdf;
use Dompdf\Options;
use App\CalendarGenerator;

// Definir el rango de años permitidos
$minYear = 2025;
$maxYear = 2050;

// Si se ha enviado el año por GET, se genera el PDF; de lo contrario se muestra el formulario.
if (isset($_GET['year'])) {
    $year = (int) $_GET['year'];
    if ($year < $minYear || $year > $maxYear) {
        $year = $minYear;
    }
    
    // Leer la hoja de estilos para el calendario (asegúrate que este archivo exista)
    $cssPath = __DIR__ . '/css/calendario.css';
    $css = file_exists($cssPath) ? file_get_contents($cssPath) : '';
    
    // Construir el HTML del PDF, inyectando la hoja de estilos inline y los estilos para salto de página.
    $html = '<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Calendario ' . $year . '</title>
  <style>
    ' . $css . '
    /* Estilos para que cada mes se imprima en una página diferente */
    .month-container { 
      page-break-after: always; 
      margin-bottom: 1em; 
    }
    /* Evitar salto de página extra después del último mes */
    .month-container:last-child {
      page-break-after: auto;
    }
    /* Opcional: centrar y dar un poco de margen al título */
    h1 { 
      text-align: center; 
      color: #ff6f61; 
      margin-top: 1em;
    }
  </style>
</head>
<body>
  <h1>Calendario del año ' . $year . '</h1>';
  
    // Generar cada mes dentro de su contenedor para forzar el salto de página.
    for ($month = 1; $month <= 12; $month++) {
        $html .= '<div class="month-container">';
        $html .= CalendarGenerator::generateCalendar($year, $month);
        $html .= '</div>';
    }
    
    $html .= '</body></html>';

    // Inicializar Dompdf con opciones básicas
    $options = new Options();
    $options->set('isRemoteEnabled', true); // Permite cargar recursos remotos si es necesario
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);

    // Establecer el tamaño de papel y la orientación (A4, orientación horizontal es común para calendarios)
    $dompdf->setPaper('A4', 'landscape');

    // Renderizar el PDF
    $dompdf->render();

    // Enviar cabeceras y el PDF al navegador
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="calendario_' . $year . '.pdf"');
    echo $dompdf->output();
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Generar PDF del Calendario</title>
  <link rel="stylesheet" href="css/pdf.css">
</head>
<body>
  <header>
    <h1>Generar PDF - Calendario</h1>
  </header>
  <main>
    <form action="pdf.php" method="get" class="pdf-form">
      <label for="year">Selecciona el año:</label>
      <select name="year" id="year">
        <?php for ($y = $minYear; $y <= $maxYear; $y++): ?>
          <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
        <?php endfor; ?>
      </select>
      <button type="submit">Generar PDF</button>
    </form>
    <p class="back-link"><a href="index.php">Volver a Inicio</a></p>
  </main>
</body>
</html>