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

    protected $listeners = ['renderRejectedDemands' => '$refresh'];

    public function render()
    {
        $userId = getUserId();

        $statusId = getStatusId('rejected');

        if (isAdmin()) {
            $rejectedDemands = Ticket::orderBy('updated_at', 'desc')->where('status_id', $statusId)->get();
        } else {
            $rejectedDemands = Ticket::orderBy('updated_at', 'desc')->where([['status_id', $statusId], ['user_id', $userId]])->get();
        }

        return view('livewire.rejected-demands', compact('rejectedDemands'));
    }

    public function exportExcel()
    {
        return Excel::download(new RejectedDemandsExport(), 'rejectedDemands.xlsx');
    }
}
