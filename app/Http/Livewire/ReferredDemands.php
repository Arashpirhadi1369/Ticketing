<?php

namespace App\Http\Livewire;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class ReferredDemands extends Component
{
    use WithPagination;

    public function render()
    {
        $userId = getUserId();

        $statusId = getStatusId('todo');

        $referredDemands = Ticket::where([['status_id', $statusId], ['referred_id', $userId]])->paginate(10);

        return view('livewire.referred-demands', compact('referredDemands'));
    }
}
