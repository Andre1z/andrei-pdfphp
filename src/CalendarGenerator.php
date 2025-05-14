<?php
// src/CalendarGenerator.php

namespace App;

/**
 * Clase para generar calendarios en formato HTML para un rango de años.
 */
class CalendarGenerator
{
    /**
     * Genera el HTML de un calendario para un mes y año específicos.
     *
     * @param int $year Año del calendario.
     * @param int $month Mes (1-12) del calendario.
     * @return string HTML del calendario.
     */
    public static function generateCalendar(int $year, int $month): string
    {
        $date = new \DateTime("$year-$month-01");
        $daysInMonth = (int)$date->format('t');
        $firstDayWeek = (int)$date->format('w');

        $monthNames = [
            1  => 'Enero',  2  => 'Febrero', 3  => 'Marzo',
            4  => 'Abril',  5  => 'Mayo',    6  => 'Junio',
            7  => 'Julio',  8  => 'Agosto',  9  => 'Septiembre',
            10 => 'Octubre',11 => 'Noviembre', 12 => 'Diciembre',
        ];
        $monthName = $monthNames[$month] ?? "Mes desconocido";

        $html = "<table class='calendario'>";
        $html .= "<thead>";
        $html .= "<tr><th colspan='7'>$monthName $year</th></tr>";
        $html .= "<tr>";
        $weekDays = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
        foreach ($weekDays as $day) {
            $html .= "<th>$day</th>";
        }
        $html .= "</tr>";
        $html .= "</thead>";
        $html .= "<tbody><tr>";

        // Las celdas vacías hasta el primer día del mes
        for ($i = 0; $i < $firstDayWeek; $i++) {
            $html .= "<td></td>";
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            if (($firstDayWeek + $day - 1) % 7 === 0 && $day !== 1) {
                $html .= "</tr><tr>";
            }
            $html .= "<td>$day</td>";
        }

        // Completar la última fila si es necesario
        $remaining = (7 - (($firstDayWeek + $daysInMonth) % 7)) % 7;
        for ($i = 0; $i < $remaining; $i++) {
            $html .= "<td></td>";
        }
        $html .= "</tr></tbody>";
        $html .= "</table>";

        return $html;
    }

    /**
     * Genera calendarios HTML para un rango de años.
     *
     * @param int $startYear Año inicial.
     * @param int $endYear Año final.
     * @return string HTML con los calendarios generados.
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