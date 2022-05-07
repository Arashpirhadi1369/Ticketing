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
        $statusId = getStatusId('open');
        $allDemands = Ticket::with('user' , 'status')
            ->where('status_id', $statusId)
            ->paginate(10);

        return view('livewire.dashboardlayouts.demandtypelayouts.inprogressdemand'
            , compact('allDemands'));
    }
}
