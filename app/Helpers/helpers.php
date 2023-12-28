<?php

function dateRange($begin, $end, $interval = null)
{
    $begin = new DateTime($begin);
    $end = new DateTime($end);

    $end = $end->modify('+1 day');
    $interval = new DateInterval($interval ? $interval : 'P1D');

    return iterator_to_array(new DatePeriod($begin, $interval, $end));
}
