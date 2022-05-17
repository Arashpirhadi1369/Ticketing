<?php

namespace App\Http\Livewire;

use App\Exports\AllDemandsExport;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketType;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class AllDemands extends Component
{
    use WithPagination;


    public function render()
    {
        $statusId = getStatusId('open');

        $allDemands = Ticket::orderBy('id', 'desc')->with('user', 'status')->where('status_id', $statusId)->get();

        return view('livewire.all-demands',
            compact('allDemands'));
    }

    public function assignToMe($id)
    {
        if ($id) {
            $ticket = Ticket::find($id);
            $ticket->referred_id = getUserId();
            $ticket->status_id = getStatusId('todo');
            $ticket->save();

            return redirect()->to('/');
        }
    }



    public function exportExcel()
    {
        return Excel::download(new AllDemandsExport(), 'allDemands.xlsx');
    }
}
