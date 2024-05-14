<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Traits\Sortable;
use App\Traits\BulkAction;
use App\Traits\ResetInput;
use Livewire\WithPagination;
use App\Models\Effectiveness;
use App\Traits\ConvertNumbers;
use App\Traits\ResetSearchFilters;
use App\Models\EffectivenessQuestion;
use App\Models\EffectivenessQuestionAnswer;

class Effectivenesses extends Component
{
    use ConvertNumbers, ResetInput, ResetSearchFilters, Sortable, BulkAction, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $entity;
    public $effectivenessQuestion;
    public $effectivenessQuestionAnswer;

    public $componentName = "effectivenesses";

    public $questions = [];
    public $answers = [];

    protected $rules = [
        'entity.name' => 'required|min:1|max:200',
        'entity.questions_count' => 'required|min:1|max:8',
        "effectivenessQuestion.*.question" => 'required|min:1|max:230',
        "effectivenessQuestionAnswer.*.answer" => 'required|min:1|max:230',

    ];

    public $filter  = 'all';

    public $filters = [
        'all'       => null,
        'name'      => null,
    ];

    public $headers = ['name', 'questions_count'];

    public $modalFields = ['name', 'questions_count'];

    public function mount(Effectiveness $entity)
    {
        $this->entity = $entity;
    }

    public function render()
    {
        if ($this->selectAll) {
            $this->selected = $this->effectivenessesQuery->pluck('id')->map(fn ($id) => (string) $id);
        }

        return view('livewire.effectivenesses', [
            'entities' => $this->entities,
            'effectivenessQuestion' => $this->effectivenessQuestion,
            'effectivenessQuestionAnswer' => $this->effectivenessQuestionAnswer
        ]);
    }

    public function getentitiesQueryProperty()
    {
        return Effectiveness::query()
            ->when(
                $this->filters['all'],
                fn ($query, $search) => $query
                    ->where('name', 'like', '%' . $search . '%')
            )

            ->when($this->filters['name'], fn ($query, $search) => $query->where('name', 'like', '%' . $search . '%'))
            ->orderby($this->sortField, $this->sortDirection);
    }

    public function getentitiesProperty()
    {
        return $this->entitiesQuery->paginate(10);
    }

    public function store()
    {
        $this->validate();
        $this->entity->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInput();
    }

    public function storeQuestions()
    {
        $this->validate();

        if (isset($this->effectivenessQuestion[0])) {
            foreach ($this->effectivenessQuestion as $effectivenessQuestion) {
                EffectivenessQuestion::where('id', $effectivenessQuestion->id)->update(['question' => $effectivenessQuestion->question]);
            }
        } else {
            foreach ($this->questions as $question) {
                EffectivenessQuestion::create([
                    'effectiveness_id' => $this->entity->id,
                    'question' => $question,
                ]);
            }
        }

        $this->dispatchBrowserEvent('closeModal');
        $this->resetInput();
    }

    public function storeAnswers()
    {
        $this->validate();

        if (isset($this->effectivenessQuestionAnswer[0])) {
            foreach ($this->effectivenessQuestionAnswer as $effectivenessQuestionAnswer) {
                EffectivenessQuestionAnswer::where('id', $effectivenessQuestionAnswer->id)->update(['answer' => $effectivenessQuestionAnswer->answer]);
            }
        } else {
            $chunkedAnswers = array_chunk($this->answers, 4);

            $questionIds = [];
            foreach ($this->effectivenessQuestion as $effectivenessQuestion) {
                $questionIds[] = $effectivenessQuestion->id;
            }

            $questionsAnswers = array_combine($questionIds, $chunkedAnswers);

            foreach ($questionsAnswers as $questionId => $answers) {
                foreach ($answers as $answer) {
                    EffectivenessQuestionAnswer::create([
                        'effectivenessquestion_id' => $questionId,
                        'answer' => $answer,
                    ]);
                }
            }
        }

        $this->dispatchBrowserEvent('closeModal');
        $this->resetInput();
    }

    public function edit(Effectiveness $entity)
    {
        $this->entity = $entity;

        if (count($this->entity->questions) == 0) {
            for ($i = 0; $i < $this->entity->questions_count; $i++) {
                $this->questions[] = null;
            }
        }

        if (count($this->entity->answers) == 0) {
            for ($i = 0; $i < 4 * count($this->entity->questions); $i++) {
                $this->answers[] = null;
            }
        }

        $this->effectivenessQuestionAnswer = $this->entity->answers;
        $this->effectivenessQuestion = $this->entity->questions;
    }

    public function destroy()
    {
        $effectivenesse = Effectiveness::find($this->entity->id);
        $effectivenesse->delete();
        $this->resetInput();
    }

    // public function exportExcel()
    // {
    //     return Excel::download(new EffectivenesssExport(), 'Effectivenesss.xlsx');
    // }
}
