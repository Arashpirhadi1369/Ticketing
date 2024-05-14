<?php

namespace App\Traits;

trait ResetInput
{
    public function resetInput()
    {
        foreach ($this->headers as $header) {
            $this->entity->$header = null;
        }

        foreach ($this->modalFields as $modalField) {
            $this->entity->$modalField = null;
        }

        // if (isset($this->entity->message)) {
        //     $this->entity->message = null;
        // }

        if (isset($this->phones)) {
            $this->phones = null;
        }

        if (count($this->questions) != 0) {
            $this->questions = [];
        }

        if (count($this->answers) != 0) {
            $this->answers = [];
        }

        if (isset($this->editMode)) {
            $this->editMode = false;
        }

        $this->entity->id = null;

        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
