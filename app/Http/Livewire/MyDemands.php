<?php

namespace App\Http\Livewire;

use App\Exports\MyDemandsExport;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class MyDemands extends Component
{
    use WithPagination;

    protected $listeners = ['renderMyDemands' => '$refresh'];

    public function render()
    {
        $userId = getUserId();

        $statusId = getStatusId('open');

        $myDemands = Ticket::orderBy('updated_at', 'desc')->with('user')->where([['status_id', $statusId], ['user_id', $userId]])->get();

        return view('livewire.my-demands', compact('myDemands'));
    }

    public function exportExcel()
    {
        return Excel::download(new MyDemandsExport, 'my-demands.xlsx');
    }
}
