<?php

namespace App\Http\Livewire;

use App\Exports\ReferredDemandsExport;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ReferredDemands extends Component
{
    use WithPagination;

    public $ticket;

    protected $rules = [
        'ticket.reply' => 'required|min:3|max:200',
    ];


    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function render()
    {
        $userId = getUserId();

        $statusId = getStatusId('todo');

        $referredDemands = Ticket::orderBy('updated_at', 'desc')->where([['status_id', $statusId], ['referred_id', $userId]])->get();

        return view('livewire.referred-demands', compact('referredDemands'));
    }

    public function update($id)
    {
        $this->validate();

        $ticket = Ticket::find($id);

        $ticket->status_id = getStatusId('done');
        $ticket->reply = $this->ticket->reply;

        $ticket->update();

        return redirect()->to('/');
    }

    public function exportExcel()
    {
        return Excel::download(new ReferredDemandsExport(), 'referredDemands.xlsx');
    }
}
