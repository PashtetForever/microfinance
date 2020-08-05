<?php
if (! function_exists('dateTo1CFormat')) {
    function dateTo1CFormat(string $date) {
        $dateArray = explode('.', $date);
        return $dateArray[2] . $dateArray[1] . $dateArray[0];
    }
}
