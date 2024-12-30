<?php

namespace App\Http\Livewire;

use App\Models\UserLog;
use App\Traits\AdvanceSearch;
use Livewire\Component;
use App\Traits\Sortable;
use App\Traits\BulkAction;
use App\Traits\ResetInput;
use Livewire\WithPagination;
use App\Traits\ConvertNumbers;
use App\Traits\ResetSearchFilters;

class UserLogs extends Component
{
    use ConvertNumbers, ResetInput, ResetSearchFilters, Sortable, BulkAction, WithPagination, AdvanceSearch;

    protected $paginationTheme = 'bootstrap';

    public $entity;

    public $componentName = "user-logs";

    protected $rules = [
        'entity.name' => 'required|min:1|max:200',
    ];

    public $filter  = 'all';

    public $filters = [
        'all'       => null,
        'user_id'   => null,
    ];

    public $headers = ["user_id", "ip", "action_id", "table_name", "record_id", "attribute", "old", "new", "created_at"];

    public $modalFields = ['asset_id'];

    public function mount(UserLog $entity)
    {
        $this->entity = $entity;
    }

    public function render()
    {
        return view('livewire.user-logs', ['entities' => $this->entities]);
    }

    public function getentitiesQueryProperty()
    {
        if ($this->filters['user_id']) {
            $userIds = $this->relationSearch('App\Models\User', 'user_id', 'name');
        }

        return UserLog::query()
            ->when(
                $this->filters['all'],
                fn($query, $search) => $query
                    ->where('record_id', $search)
            )

            ->when($this->filters['user_id'], fn($query) => $query->wherein('user_id', $userIds))
            ->orderby($this->sortField, $this->sortDirection);
    }

    public function getentitiesProperty()
    {
        return $this->entitiesQuery->paginate(10);
    }
}
