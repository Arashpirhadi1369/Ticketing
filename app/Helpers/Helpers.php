<?php

use App\Models\TicketStatus;
use App\Models\TicketType;

if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        if (!empty(auth()->user()->ou) && auth()->user()->ou == 'IT') {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('getUserId')) {
    function getUserId()
    {
        return auth()->user()->id;
    }
}

if (!function_exists('getStatusId')) {
    function getStatusId($statusName)
    {
        $status = TicketStatus::where('status', $statusName)->get();

        if ($status->isNotEmpty()) {
            return $status[0]->id;
        }
    }
}

if (!function_exists('getTypeId')) {
    function getTypeId($typeName)
    {
        $type = TicketType::where('type', $typeName)->get();

        if ($type->isNotEmpty()) {
            return $type[0]->id;
        }
    }
}
