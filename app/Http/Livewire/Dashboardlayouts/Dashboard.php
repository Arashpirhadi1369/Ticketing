<?php

namespace App\Http\Livewire\Dashboardlayouts;

use App\Models\User;
use App\Models\Ticket;
use App\Traits\Smsable;
use Livewire\Component;
use App\Models\CourseUser;

class Dashboard extends Component
{
    use Smsable;

    public $ticket;

    public $showSavedButton = 1;

    public $unfinishedSurveys;

    public $unfinishedEffectivenesses;

    protected $listeners = ['renderDashboard' => '$refresh'];

    protected $rules = [
        'ticket.subject' => 'required|min:3|max:60',
        'ticket.content' => 'required|min:5|max:254',
    ];

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function render()
    {
        $surverCount = count(CourseUser::where([['user_id', getUserId()], ['survey_finished_date', null]])->get());
        if ($surverCount > 0) {
            $this->unfinishedSurveys = $surverCount;
        }

        $effectivenessCount = count(CourseUser::where([['manager_user_id', getUserId()], ['effectiveness_finished_date', null]])->get());
        if ($effectivenessCount > 0) {
            $this->unfinishedEffectivenesses = $effectivenessCount;
        }

        return view('livewire.dashboardlayouts.dashboard');
    }

    public function store()
    {
        $this->validate();

        if ($this->showSavedButton == 1) {

            $this->showSavedButton = 0;

            $userId = $this->ticket->user_id = getUserId();

            Ticket::create([
                'user_id' => $userId,
                'subject' => $this->ticket->subject,
                'content' => $this->ticket->content
            ]);

            $users = User::where('ou', '=', 'IT')->get();

            foreach ($users as $user) {
                if ($user->phone != null) {
                    $demanderUser = User::where('id', '=', $userId)->get();

                    $demanderName = $demanderUser[0]->name;
                    $message = 'درخواست جدید' . "\n" . 'درخواست دهنده : ' . __($demanderName) . "\n" . 'موضوع : ' . $this->ticket->subject;

                    $this->sendSms($user->phone, $message);
                }
            }

            $this->dispatchBrowserEvent('closeModal');

            $this->emit('renderMyDemands');
            $this->emit('renderAllDemands');
        }
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
