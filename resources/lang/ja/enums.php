<?php 

use App\Enums\VacationType;

return [
    VacationType::class => [
        VacationType::FULL_DAY => '有給1日',
        VacationType::MORNING => '有給0.5日午前',
        VacationType::AFTERNOON => '有給0.5日午後',
    ],
];