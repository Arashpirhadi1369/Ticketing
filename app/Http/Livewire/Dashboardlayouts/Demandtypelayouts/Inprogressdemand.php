<?php

namespace App\Http\Livewire\Dashboardlayouts\Demandtypelayouts;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class Inprogressdemand extends Component
{

    use WithPagination;


    protected $listeners = ['render'];








    public function render()
    {
        $userId = getUserId();

        $statusId = getStatusId('todo');

        $inprogressDemands = Ticket::where([['status_id', $statusId], ['user_id', $userId]])->paginate(10);

        return view(
            'livewire.dashboardlayouts.demandtypelayouts.inprogressdemand',
            compact('inprogressDemands')
        );
    }
}
