<?php

namespace App\Traits;

trait Sortable
{
    public $sortField = 'created_at';

    public $sortDirection = 'desc';

    public function sortby($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = 'asc';
        }
        $this->sortField = $field;
    }
}
