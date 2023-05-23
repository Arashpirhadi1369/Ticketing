<?php

namespace App\Traits;

trait ResetSearchFilters
{
    public function resetFilters()
    {
        foreach ($this->filters as $key => $value) {
            $this->filters[$key] = null;
        }
    }
}
