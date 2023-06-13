<?php

namespace App\Http\Livewire;

use App\Exports\ReferredDemandsExport;
use App\Models\Sms;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\User;
use App\Traits\Smsable;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ReferredDemands extends Component
{
    use Smsable, WithPagination;

    public $ticket;

    public $sendSms = false;

    protected $listeners = ['renderReferredDemands' => '$refresh'];

    protected $rules = [
        'ticket.reply' => 'required|min:3|max:200',
        'ticket.status_id' => 'required',
        'ticket.type_id' => 'required',
    ];

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function render()
    {
        $userId = getUserId();

        $statusId = getStatusId('todo');

        $users = User::all();

        $ticketStatuses = TicketStatus::all();

        $ticketTypes = TicketType::all();

        $referredDemands = Ticket::orderBy('updated_at', 'desc')->where([['status_id', $statusId], ['referred_id', $userId]])->get();

        return view('livewire.referred-demands', compact('referredDemands', 'users', 'ticketStatuses', 'ticketTypes'));
    }

    public function edit(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function update()
    {
        $this->validate();

        $ticket = Ticket::find($this->ticket->id);

        $ticket->status_id = $this->ticket->status_id;
        $ticket->type_id = $this->ticket->type_id;
        $ticket->reply = $this->ticket->reply;

        $ticket->update();

        if ($this->sendSms == true) {
            $user = User::find($ticket->user_id);

            $message = __($user->name) . ' گرامی
درخواست شما با عنوان : ' . $ticket->subject . '
به وضعیت : ' . __($ticket->status->status) . '
تغییر پیدا کرد';

            $results = $this->sendSms($user->phone, $message);

            foreach ($results as $result) {
                Sms::create(
                    [
                        'sender_user_id'        => auth()->user()->id,
                        'source_number'         => env("KAVENEGAR_SENDER_NUMBER"),
                        'receiver_user_id'      => $user->id,
                        'destination_number'    => $user->phone,
                        'receiver_name'         => $user->name,
                        'message'               => $message,
                        'status'                => $result->status,
                        'cost'                  => $result->cost,
                    ]
                );
            }

            $this->resetInput();

            $this->dispatchBrowserEvent('smsUncheckButton');
        }

        $this->dispatchBrowserEvent('closeModal');

        $this->emit('renderDoneDemands');
        $this->emit('renderRejectedDemands');
    }

    public function resetInput()
    {
        $this->ticket->id = null;
        $this->ticket->status_id = null;
        $this->ticket->type_id = null;
        $this->ticket->reply = null;
        $this->sendSms = false;

        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function smsCheckbox()
    {
        if ($this->sendSms == false) {
            $this->sendSms = true;
        } else {
            $this->sendSms = false;
        }
    }

    public function exportExcel()
    {
        return Excel::download(new ReferredDemandsExport(), 'referredDemands.xlsx');
    }
}
