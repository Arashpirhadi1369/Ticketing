<?php

namespace App\Http\Livewire;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class InprogressDemands extends Component
{
    use WithPagination;

    public function render()
    {
        $userId = getUserId();

        $statusId = getStatusId('todo');

        $inprogressDemands = Ticket::where([['status_id', $statusId], ['user_id', $userId]])->paginate(10);

        return view('livewire.inprogress-demands', compact('inprogressDemands'));
    }
}
