<?php

if (!function_exists('formatRole')) {
    function formatRole($role = \App\Enums\UserRole::STAFF)
    {
        $arrRole = [
            \App\Enums\UserRole::MANAGER => 'manager',
            \App\Enums\UserRole::STAFF => 'staff',
            \App\Enums\UserRole::APPROVER => 'staff',
        ];
        
        return $arrRole[$role];
    }
}