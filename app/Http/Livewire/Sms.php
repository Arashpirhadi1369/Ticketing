<?php

namespace App\Http\Livewire;

use App\Traits\Smsable;
use Livewire\Component;
use App\Traits\Sortable;
use App\Exports\SmsExport;
use App\Traits\ResetInput;
use Livewire\WithPagination;
use App\Traits\ConvertNumbers;
use App\Models\Sms as ModelsSms;
use App\Traits\ResetSearchFilters;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class Sms extends Component
{
    use Smsable, ConvertNumbers, ResetInput, ResetSearchFilters, Sortable, WithPagination;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $entity;

    public $componentName = "sms";

    protected $rules = [
        'entity.receiver_name' => '',
        'entity.destination_number' => 'required|min:11',
        'entity.message' => 'required|min:11|max:200',
    ];

    public $filter  = 'all';

    public $filters = [
        'all'                => null,
        'receiver_name'      => null,
        'destination_number' => null,
    ];

    public $headers = ['source_number', 'receiver_name', 'destination_number', 'status', 'created_at'];

    public $modalFields = ['receiver_name', 'destination_number', 'message'];

    public function mount(ModelsSms $entity)
    {
        $this->entity = $entity;
        $this->entity->message = '
        
شرکت محافظان بهبود آب';
    }

    public function render()
    {
        return view('livewire.sms', ['entities' => $this->entities]);
    }

    public function getentitiesQueryProperty()
    {
        return ModelsSms::query()
            ->when($this->filters['all'], fn ($query, $search) => $query
                ->where('receiver_name', 'like', '%' . $search . '%')
                ->orwhere('destination_number', 'like', '%' . $search . '%'))

            ->when($this->filters['receiver_name'], fn ($query, $search) => $query->where('receiver_name', 'like', '%' . $search . '%'))
            ->when($this->filters['destination_number'], fn ($query, $search) => $query->where('destination_number', 'like', '%' . $search . '%'))
            ->orderby($this->sortField, $this->sortDirection);
    }

    public function getentitiesProperty()
    {
        return $this->entitiesQuery->paginate(10);
    }

    public function store()
    {
        $this->validate();
        $this->entity->destination_number = $this->faToen($this->entity->destination_number);

        $results = $this->sendSms($this->entity->destination_number, $this->entity->message);

        foreach ($results as $result) {
            DB::table('sms')->insert([
                'sender_user_id' => auth()->user()->id,
                'source_number' => $result->sender,
                'destination_number' => $result->receptor,
                'receiver_name' => $this->entity->receiver_name,
                'message' => $result->message,
                'status' => $result->status,
                'cost' => $result->cost,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->dispatchBrowserEvent('closeModal');
        $this->resetInput();
    }

    public function edit(ModelsSms $entity)
    {
        $this->entity = $entity;
    }

    public function destroy()
    {
        $user = ModelsSms::find($this->entity->id);
        $user->delete();
        $this->resetInput();
    }

    public function exportExcel()
    {
        return Excel::download(new SmsExport(), 'sms.xlsx');
    }
}
