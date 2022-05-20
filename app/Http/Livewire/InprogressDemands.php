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

    protected $listeners = ['renderInprogressDemands' => '$refresh'];

    public function render()
    {
        $userId = getUserId();

        $statusId = getStatusId('todo');

        $inprogressDemands = Ticket::orderBy('updated_at', 'desc')->with('referred')->where([['status_id', $statusId], ['user_id', $userId]])->get();

        return view('livewire.inprogress-demands', compact('inprogressDemands'));
    }

    public function exportExcel()
    {

        return Excel::download(new InprogressDemandsExport(), 'inprogressDemands.xlsx');
    }
}
