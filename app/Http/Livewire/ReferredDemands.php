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

    public function render()
    {
        $userId = getUserId();

        $statusId = getStatusId('todo');

        $referredDemands = Ticket::where([['status_id', $statusId], ['referred_id', $userId]])->get();

        return view('livewire.referred-demands', compact('referredDemands'));
    }

    public function exportExcel()
    {
        return Excel::download(new ReferredDemandsExport(), 'referredDemands.xlsx');
    }
}
