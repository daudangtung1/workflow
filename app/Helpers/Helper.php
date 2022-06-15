<?php

if (!function_exists('formatRole')) {
    function formatRole($role = \App\Enums\UserRole::STAFF)
    {
        $arrRole = [
            \App\Enums\UserRole::MANAGER  => 'manager',
            \App\Enums\UserRole::STAFF    => 'staff',
            \App\Enums\UserRole::APPROVER => 'staff',
        ];

        return $arrRole[$role];
    }
}

if (!function_exists('getTotalMinutes')) {
    function getTotalMinutes($records)
    {
        if (empty($records)) {
            return 0;
        }

        $totalMinutes = 0;
        foreach ($records as $record) {
            if (!empty($record->end_time) && !empty($record->start_time)) {
                $endTime = \Carbon\Carbon::parse($record->end_time);
                $startTime = \Carbon\Carbon::parse($record->start_time);
                $totalMinutes = $totalMinutes + $endTime->diffInMinutes($startTime);
            }
        }
        return $totalMinutes;
    }
}

if (!function_exists('checkApproved')) {
    function checkApproved($records)
    {
        if (empty($records)) {
            return false;
        }

        foreach ($records as $record) {
            if (empty($record->approval_date)) {
                return false;
            }
        }

        return true;
    }
}

if (!function_exists('getRecordIds')) {
    function getRecordIds($records)
    {
        if (empty($records)) {
            return [];
        }

        $ids = [];
        foreach ($records as $record) {
            $ids[] = $record->id;
        }

        return $ids;
    }
}
