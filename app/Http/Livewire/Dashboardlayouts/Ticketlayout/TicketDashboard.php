<?php

namespace App\Http\Livewire\Dashboardlayouts\Ticketlayout;

use App\Models\Ticket;
use Livewire\Component;

class TicketDashboard extends Component
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
        return view('livewire.dashboardlayouts.ticketlayout.ticket-dashboard');
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

    public function store()
    {
        $this->validate();

        $this->ticket->save();

        $this->resetInput();
    }

    public function edit(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function update()
    {
        $this->validate();

        $this->ticket->update();

        $this->resetInput();
    }

    public function destroy($id)
    {
        if ($id) {
            $ticket = Ticket::where('id', $id);
            $ticket->delete();
        }

        $this->resetInput();
    }
}
