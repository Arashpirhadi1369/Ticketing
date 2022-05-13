<?php

namespace App\Http\Livewire;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class RejectedDemands extends Component
{
    use WithPagination;

    public function render()
    {
        $userId = getUserId();

        $statusId = getStatusId('rejected');

        $rejectedDemands = Ticket::where([['status_id', $statusId], ['user_id', $userId]])->get();

        $countDemands = Ticket::where('status_id',$statusId)->count();

        return view('livewire.rejected-demands', compact('rejectedDemands' , 'countDemands'));
    }
}
