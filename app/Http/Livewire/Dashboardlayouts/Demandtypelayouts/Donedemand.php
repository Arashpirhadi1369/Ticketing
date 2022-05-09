<?php

namespace App\Http\Livewire\Dashboardlayouts\Demandtypelayouts;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class Donedemand extends Component
{
    use WithPagination;

    public function render()
    {
        $userId = getUserId();

        $statusId = getStatusId('done');

        $doneDemands = Ticket::where([['status_id', $statusId], ['user_id', $userId]])->paginate(10);

        return view('livewire.dashboardlayouts.demandtypelayouts.donedemand', compact('doneDemands'));
    }
}
