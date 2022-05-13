<?php

namespace App\Http\Livewire;

use App\Exports\AllDemandsExport;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use function PHPUnit\Framework\isNull;

class AllDemands extends Component
{
    use WithPagination;


    public function assignToMe()
    {

    }




    public function render()
    {
        $statusId = getStatusId('open');

        $allDemands = Ticket::with('user', 'status')->where('status_id', $statusId)->get();

        $countDemands = Ticket::where('status_id',$statusId)->count();

        return view('livewire.all-demands', compact('allDemands' , 'countDemands'));
    }

    public function exportExcel(){
        return Excel::download(new AllDemandsExport(),'allDemands.xlsx');
    }

}
