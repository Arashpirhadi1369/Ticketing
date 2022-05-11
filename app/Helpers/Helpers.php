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

    if (!function_exists('getEndColumn')) {
        function getEndColumn($count)
        {
            $alphabet = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];

            foreach ($alphabet as $key => $value) {
                if ($key == $count - 1) {
                    return $value;
                }
            }
        }
    }
}
