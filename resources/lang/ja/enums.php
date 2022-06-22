<?php

use App\Enums\AbsenceOption;
use App\Enums\ApproverStatus;
use App\Enums\ManagerStatus;
use App\Enums\UserType;
use App\Enums\VacationType;

return [
    VacationType::class => [
        VacationType::FULL_DAY => '有給1日',
        VacationType::MORNING => '有給0.5日午前',
        VacationType::AFTERNOON => '有給0.5日午後',
        VacationType::FULL_DAY_SPECIAL => '特別休暇1日',
        VacationType::MORNING_SPECIAL => '特別休暇0.5日午前',
        VacationType::AFTERNOON_SPECIAL => '特別休暇0.5日午後',
        VacationType::FIRST => '1時間',
        VacationType::SECOND => '2時間',
        VacationType::THIRD => '3時間',
    ],
    AbsenceOption::class => [
        AbsenceOption::FIRST => '１時間',
        AbsenceOption::SECOND => '2時間',
        AbsenceOption::THIRD => '3時間',
    ],
    UserType::class => [
        UserType::FULLTIME => '正社員',
        UserType::PARTTIME => 'パート',
    ],
    ApproverStatus::class => [
        ApproverStatus::APPROVED => '承認',
        ApproverStatus::PENDING => '未承認',
        ApproverStatus::ALL => '全て',
    ], 
    ManagerStatus::class => [
        ManagerStatus::PROCESSED => '処理済み',
        ManagerStatus::PENDING => '未処理',
        ManagerStatus::ALL => '全て',
    ],
];
