<?php

namespace App\Traits;

trait BulkAction
{
    public $selected = [];

    public $selectPage = false;

    public $selectAll = false;


    public function updatedselected()
    {
        $this->selectAll = false;
        $this->selectPage = false;
    }

    public function selectAll()
    {
        $this->selectAll = true;
    }

    public function deselectAll()
    {
        $this->selectAll = false;
        $this->selectPage = false;
        $this->selected = [];
    }

    public function updatedselectPage($value)
    {
        if ($this->selectAll == true) {
            $this->deselectAll();
        }
        $this->selected = $value
            ? $this->entities->pluck('id')->map(fn ($id) => (string) $id)
            : [];
    }
}
