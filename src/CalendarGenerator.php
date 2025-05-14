<?php

namespace App;

/**
 * Clase que genera calendarios en formato HTML para un rango de años.
 *
 * Esta clase contiene métodos estáticos para generar el calendario de un mes
 * y para generar calendarios completos en un rango de años, mostrando nombres de meses
 * y días en español.
 */
class CalendarGenerator
{
    /**
     * Genera el HTML de una tabla representando el calendario de un mes específico.
     *
     * @param int $year Año del calendario.
     * @param int $month Mes (de 1 a 12) del calendario.
     * @return string HTML del calendario generado.
     */
    public static function generateCalendar(int $year, int $month): string
    {
        // Crear un objeto DateTime para el primer día del mes.
        $date = new \DateTime("$year-$month-01");

        // Obtener el número total de días del mes.
        $daysInMonth = (int)$date->format('t');

        // Obtener el día de la semana del primer día (0 = Domingo, 6 = Sábado).
        $firstDayWeek = (int)$date->format('w');

        // Nombres de los meses en español.
        $monthNames = [
            1  => 'Enero',  2  => 'Febrero', 3  => 'Marzo',
            4  => 'Abril',  5  => 'Mayo',    6  => 'Junio',
            7  => 'Julio',  8  => 'Agosto',  9  => 'Septiembre',
            10 => 'Octubre',11 => 'Noviembre', 12 => 'Diciembre'
        ];
        $monthName = $monthNames[$month];

        // Construir el HTML del calendario.
        $output = "<table class='calendario'>";
        $output .= "<thead>";
        $output .= "<tr><th colspan='7'>$monthName $year</th></tr>";

        // Encabezados de los días de la semana (en español).
        $weekDays = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
        $output .= "<tr>";
        foreach ($weekDays as $dayName) {
            $output .= "<th>$dayName</th>";
        }
        $output .= "</tr>";
        $output .= "</thead>";
        $output .= "<tbody>";

        // Iniciar la primera fila y agregar celdas vacías hasta el primer día.
        $output .= "<tr>";
        for ($i = 0; $i < $firstDayWeek; $i++) {
            $output .= "<td></td>";
        }

        // Llenar la tabla con los días del mes.
        for ($day = 1; $day <= $daysInMonth; $day++) {
            // Si se inicia una nueva semana, cerrar la fila anterior.
            if (($firstDayWeek + $day - 1) % 7 === 0 && $day != 1) {
                $output .= "</tr><tr>";
            }
            $output .= "<td>$day</td>";
        }

        // Completar la fila final con celdas vacías si es necesario.
        $remainingCells = (7 - (($firstDayWeek + $daysInMonth) % 7)) % 7;
        for ($i = 0; $i < $remainingCells; $i++) {
            $output .= "<td></td>";
        }
        $output .= "</tr>";

        $output .= "</tbody>";
        $output .= "</table>";

        return $output;
    }

    /**
     * Genera calendarios HTML para un rango de años.
     *
     * @param int $startYear Año inicial.
     * @param int $endYear Año final.
     * @return string HTML con los calendarios generados para cada año.
     */
    public static function generateCalendars(int $startYear, int $endYear): string
    {
        $calendarsHTML = "";
        for ($year = $startYear; $year <= $endYear; $year++) {
            $calendarsHTML .= "<div class='anio'>";
            $calendarsHTML .= "<h2>Año: $year</h2>";
            for ($month = 1; $month <= 12; $month++) {
                $calendarsHTML .= self::generateCalendar($year, $month);
            }
            $calendarsHTML .= "</div>";
        }
        return $calendarsHTML;
    }
}