<?php

namespace App\Http\Livewire;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class AllDemands extends Component
{
    use WithPagination;

    public function render()
    {
        $statusId = getStatusId('open');

        $allDemands = Ticket::with('user', 'status')->where('status_id', $statusId)->paginate(10);

        return view('livewire.all-demands', compact('allDemands'));
    }
}
