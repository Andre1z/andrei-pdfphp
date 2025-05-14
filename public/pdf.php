<?php
// public/pdf.php

// Activamos la visualización de errores para desarrollo
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

// Si se ha enviado el año por GET, se genera el PDF; de lo contrario, se muestra el formulario.
if (isset($_GET['year'])) {
    $year = (int) $_GET['year'];
    if ($year < $minYear || $year > $maxYear) {
        $year = $minYear;
    }

    // Leer la hoja de estilos (asegúrate de que el archivo existe en la ruta indicada)
    $cssPath = __DIR__ . '/css/calendario.css';
    $css = file_exists($cssPath) ? file_get_contents($cssPath) : '';

    // Construir el HTML del calendario con estilo inline
    $html = '<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Calendario ' . $year . '</title>
  <style>' . $css . '</style>
</head>
<body>
  <h1 style="text-align:center; color:#ff6f61;">Calendario del año ' . $year . '</h1>
  <div class="calendar-year">';
    for ($month = 1; $month <= 12; $month++) {
        $html .= CalendarGenerator::generateCalendar($year, $month);
    }
    $html .= '</div>
</body>
</html>';

    // Inicializar Dompdf con opciones básicas
    $options = new Options();
    $options->set('isRemoteEnabled', true); // Para cargar recursos remotos, si fuera el caso.
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);

    // (Opcional) Puedes ajustar el tamaño de papel y la orientación
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