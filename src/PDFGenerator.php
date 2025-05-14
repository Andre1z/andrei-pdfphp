<?php

namespace App;

use Knp\Snappy\Pdf;

/**
 * Clase para generar PDFs a partir de HTML o de una URL utilizando wkhtmltopdf a través de Knp\Snappy.
 */
class PDFGenerator
{
    /**
     * Instancia de Knp\Snappy\Pdf.
     *
     * @var Pdf
     */
    protected $snappy;

    /**
     * Constructor.
     *
     * Es fundamental que se le pase la ruta correcta del ejecutable wkhtmltopdf.
     * En Windows, una ruta común es:
     * "C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltopdf.exe"
     *
     * @param string $wkhtmltopdfPath Ruta al ejecutable wkhtmltopdf.
     */
    public function __construct(string $wkhtmltopdfPath)
    {
        $this->snappy = new Pdf($wkhtmltopdfPath);
    }

    /**
     * Genera un PDF a partir de un contenido HTML.
     *
     * @param string $html El contenido HTML a convertir.
     * @return string Salida binaria del PDF generado.
     */
    public function generateFromHtml(string $html): string
    {
        return $this->snappy->getOutputFromHtml($html);
    }

    /**
     * Genera un PDF a partir de una URL.
     *
     * @param string $url La URL a convertir.
     * @return string Salida binaria del PDF generado.
     */
    public function generateFromUrl(string $url): string
    {
        return $this->snappy->getOutput($url);
    }

    /**
     * Guarda en un archivo el PDF generado a partir de un contenido HTML.
     *
     * @param string $html El contenido HTML a convertir.
     * @param string $filePath Ruta y nombre del archivo donde se guardará el PDF.
     * @return bool Verdadero si se guarda correctamente, falso en caso contrario.
     */
    public function saveFromHtml(string $html, string $filePath): bool
    {
        $pdfOutput = $this->generateFromHtml($html);
        return file_put_contents($filePath, $pdfOutput) !== false;
    }

    /**
     * Guarda en un archivo el PDF generado a partir de una URL.
     *
     * @param string $url La URL a convertir.
     * @param string $filePath Ruta y nombre del archivo donde se guardará el PDF.
     * @return bool Verdadero si se guarda correctamente, falso en caso contrario.
     */
    public function saveFromUrl(string $url, string $filePath): bool
    {
        $pdfOutput = $this->generateFromUrl($url);
        return file_put_contents($filePath, $pdfOutput) !== false;
    }
}