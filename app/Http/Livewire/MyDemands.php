<?php

namespace App\Http\Livewire;

use App\Exports\MyDemandsExport;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class MyDemands extends Component
{
    use WithPagination;

    public $ticket;

    protected $rules = [
        'ticket.subject' => 'required|min:3|max:30',
        'ticket.content' => 'required|min:10|max:100',
    ];

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }


    public function render()
    {
        $userId = getUserId();

        $statusId = getStatusId('open');

        $myDemands = Ticket::where([['status_id', $statusId], ['user_id', $userId]])->paginate(10);

        return view('livewire.my-demands', compact('myDemands'));
    }

    public function resetInput()
    {
        $this->ticket->id = null;
        $this->ticket->subject = null;
        $this->ticket->content = null;

        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();

        $this->ticket->save();

        $this->resetInput();
    }

    public function edit(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function update()
    {
        $this->validate();

        $this->ticket->update();

        $this->resetInput();
    }

    public function destroy($id)
    {
        if ($id) {
            $ticket = Ticket::where('id', $id);
            $ticket->delete();
        }

        $this->resetInput();
    }

    public function exportExcel()
    {
        return Excel::download(new MyDemandsExport, 'my-demands.xlsx');
    }
}
