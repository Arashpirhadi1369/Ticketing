<?php

namespace App\Http\Livewire;

use App\Exports\DoneDemandsExport;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class DoneDemands extends Component
{
    use WithPagination;

    protected $listeners = ['renderDoneDemands' => '$refresh'];

    public function render()
    {
        $userId = getUserId();

        $statusId = getStatusId('done');

        if (isAdmin()) {
            $doneDemands = Ticket::orderBy('updated_at', 'desc')->where('status_id', $statusId)->get();
        } else {
            $doneDemands = Ticket::orderBy('updated_at', 'desc')->where([['status_id', $statusId], ['user_id', $userId]])->get();
        }

        return view('livewire.done-demands', compact('doneDemands'));
    }

    public function exportExcel()
    {
        return Excel::download(new DoneDemandsExport(), 'doneDemands.xlsx');
    }
}
