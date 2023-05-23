<?php

namespace App\Traits;

trait AdvanceSearch
{

    public $show_filters = false;

    public function updatedfilters()
    {
        $this->resetPage();
    }
}
