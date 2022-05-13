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

    public function render()
    {
        $userId = getUserId();

        $statusId = getStatusId('done');

        $doneDemands = Ticket::where([['status_id', $statusId], ['user_id', $userId]])->get();

        $countDemands = Ticket::where('status_id',$statusId)->count();

        return view('livewire.done-demands', compact('doneDemands' , 'countDemands'));
    }

    public function exportExcel(){
        return Excel::download(new DoneDemandsExport() , 'DoneDemands.xlsx');
    }
}
