<?php

use Carbon\Carbon;

function formattedDate($date) {
    $carbonDate = Carbon::parse($date);
    $day = (int) $carbonDate->format('j');
    $suffix = match (true) {
        $day >= 11 && $day <= 13 => 'th',
        $day % 10 === 1 => 'st',
        $day % 10 === 2 => 'nd',
        $day % 10 === 3 => 'rd',
        default => 'th',
    };
    return $day . $suffix . ' ' . $carbonDate->format('M, Y');
}
function formattedTime($datetime) {
    return \Carbon\Carbon::parse($datetime)->format('g:i A');
}
