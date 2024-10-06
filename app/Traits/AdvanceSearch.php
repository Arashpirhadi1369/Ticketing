<?php

namespace App\Traits;

trait AdvanceSearch
{

    public $show_filters = false;

    public function updatedfilters()
    {
        $this->resetPage();
    }

    public function relationSearch($model, $filter, $column)
    {
        $records = $model::query()->when(
            $this->filters[$filter],
            fn($query, $search) => $query
                ->where($column, 'like', '%' . $search . '%')
        )->get();

        $ids = [];
        foreach ($records as $record) {
            $ids[] = $record->id;
        }

        return $ids;
    }
}
