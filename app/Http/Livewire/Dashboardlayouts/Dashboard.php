<?php

namespace App\Http\Livewire\Dashboardlayouts;

use App\Models\Ticket;
use Livewire\Component;

class Dashboard extends Component
{
    public $ticket;

    protected $rules = [
        'ticket.subject' => 'required|min:3|max:30',
        'ticket.content' => 'required|min:10|max:100',
    ];

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function render()
    {
        return view('livewire.dashboardlayouts.dashboard');
    }

    public function store()
    {
        $this->validate();

        $this->ticket->user_id = getUserId();
        $this->ticket->save();

        $this->resetInput();
    }

    public function resetInput()
    {
        $this->ticket->id = null;
        $this->ticket->subject = null;
        $this->ticket->content = null;

        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
