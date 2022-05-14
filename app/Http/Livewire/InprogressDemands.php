<?php

namespace App\Http\Livewire;

use App\Exports\InprogressDemandsExport;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class InprogressDemands extends Component
{
    use WithPagination;

    public function render()
    {
        $userId = getUserId();

        $statusId = getStatusId('todo');

        $inprogressDemands = Ticket::where([['status_id', $statusId], ['user_id', $userId]])->get();

        return view('livewire.inprogress-demands', compact('inprogressDemands'));
    }
    public function exportExcel(){

        return Excel::download(new InprogressDemandsExport(),'inprogressDemands.xlsx');

    }

}
