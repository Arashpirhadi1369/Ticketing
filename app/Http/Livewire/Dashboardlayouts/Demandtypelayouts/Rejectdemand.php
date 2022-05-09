<?php

namespace App\Http\Livewire\Dashboardlayouts\Demandtypelayouts;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class Rejectdemand extends Component
{
    use WithPagination;


    public function render()
    {
        $userId = getUserId();

        $statusId = getStatusId('rejected');

        $rejectedDemands = Ticket::where([['status_id', $statusId], ['user_id', $userId]])->paginate(10);

        return view(
            'livewire.dashboardlayouts.demandtypelayouts.rejectdemand',
            compact('rejectedDemands')
        );
    }
}
