<?php

namespace App\Http\Livewire;

use App\Traits\Smsable;
use Livewire\Component;
use App\Traits\Sortable;
use App\Exports\SmsExport;
use App\Models\Phonebook;
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

    protected $paginationTheme = 'bootstrap';

    public $entity;

    public $phonebooks;

    public $phones;

    public $infoEntity;

    public $componentName = "sms";

    protected $rules = [
        'entity.subject' => '',
        'phones' => 'required',
        // 'entity.receiver_name' => '',
        // 'entity.destination_number' => 'required|min:11',
        'entity.message' => 'required|min:11|max:200',
    ];

    public $filter  = 'all';

    public $filters = [
        'all'                => null,
        'subject'            => null,
        'receiver_name'      => null,
        'destination_number' => null,
    ];

    public $headers = ['source_number', 'subject', 'receiver_name', 'destination_number', 'status', 'created_at'];

    public $modalFields = ['subject', 'phonebook', 'message'];

    public function mount(ModelsSms $entity)
    {
        $this->entity = $entity;
        $this->infoEntity = $entity;
        $this->phonebooks = Phonebook::get();

        //         $this->entity->message = '

        // شرکت محافظان بهبود آب';
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
                ->orwhere('subject', 'like', '%' . $search . '%')
                ->orwhere('destination_number', 'like', '%' . $search . '%'))

            ->when($this->filters['receiver_name'], fn ($query, $search) => $query->where('receiver_name', 'like', '%' . $search . '%'))
            ->when($this->filters['subject'], fn ($query, $search) => $query->where('subject', 'like', '%' . $search . '%'))
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

        $phonebook = Phonebook::whereIn('id', $this->phones)->get();

        $this->entity->destination_number = $phonebook->implode('phone', ',');

        // $this->entity->destination_number = $this->faToen($this->entity->destination_number);

        $results = $this->sendSms($this->entity->destination_number, $this->entity->message);

        foreach ($results as $result) {
            $receiverName = Phonebook::where('phone', $result->receptor)->get('name');

            DB::table('sms')->insert([
                'sender_user_id' => auth()->user()->id,
                'source_number' => $result->sender,
                'destination_number' => $result->receptor,
                'receiver_name' => $receiverName[0]->name,
                'subject' => $this->entity->subject,
                'message' => $result->message,
                'status' => $result->status,
                'cost' => $result->cost,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->dispatchBrowserEvent('closeModal');
        $this->emit('stored');
        $this->resetInput();
    }

    public function edit(ModelsSms $entity)
    {
        $this->infoEntity = $entity;
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
