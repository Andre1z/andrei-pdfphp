<?php
// public/index.php
require_once __DIR__ . '/../vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Página Principal - PDF Calendario</title>
  <link rel="stylesheet" href="css/index.css">
</head>
<body>
  <header>
    <h1>PDF Calendario</h1>
  </header>
  <nav>
    <ul>
      <li><a href="calendario.php">Ver Calendario</a></li>
      <li><a href="pdf.php">Generar PDF</a></li>
    </ul>
  </nav>
  <main>
    <section>
      <p>
        Bienvenido a nuestra aplicación, donde podrás ver calendarios generados dinámicamente
        y crear PDF's con un diseño minimalista y colores vivos.
      </p>
    </section>
  </main>
  <footer>
    <p>&copy; <?php echo date("Y"); ?> PDF Calendario</p>
  </footer>
</body>
</html>