<?php

namespace App\Http\Livewire;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class MyDemands extends Component
{
    use WithPagination;

    public function render()
    {
        $userId = getUserId();

        $statusId = getStatusId('open');

        $myDemands = Ticket::where([['status_id', $statusId], ['user_id', $userId]])->paginate(10);

        return view('livewire.my-demands', compact('myDemands'));
    }
}
