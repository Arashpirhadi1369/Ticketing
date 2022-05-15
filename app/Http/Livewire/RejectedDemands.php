<?php

namespace App\Http\Livewire;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RejectedDemandsExport;

class RejectedDemands extends Component
{
    use WithPagination;

    public function render()
    {
        $userId = getUserId();

        $statusId = getStatusId('rejected');

        $rejectedDemands = Ticket::orderBy('id', 'desc')->where([['status_id', $statusId], ['user_id', $userId]])->get();

        return view('livewire.rejected-demands', compact('rejectedDemands'));
    }

    public function exportExcel()
    {
        return Excel::download(new RejectedDemandsExport(), 'rejectedDemands.xlsx');
    }
}
