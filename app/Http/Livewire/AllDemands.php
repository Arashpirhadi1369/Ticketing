<?php

namespace App\Http\Livewire;

use App\Exports\AllDemandsExport;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class AllDemands extends Component
{
    use WithPagination;

    protected $listeners = ['renderAllDemands' => '$refresh'];

    public function render()
    {
        $statusId = getStatusId('open');

        $allDemands = Ticket::orderBy('id', 'desc')->with('user', 'status')->where('status_id', $statusId)->get();

        return view('livewire.all-demands', compact('allDemands'));
    }

    public function assignToMe($id)
    {
        if ($id) {
            $ticket = Ticket::find($id);

            $ticket->referred_id = getUserId();
            $ticket->status_id = getStatusId('todo');

            $ticket->save();

            $this->emit('renderReferredDemands');
        }
    }

    public function exportExcel()
    {
        return Excel::download(new AllDemandsExport(), 'allDemands.xlsx');
    }
}
