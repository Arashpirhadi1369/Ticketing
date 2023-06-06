<?php

namespace App\Traits;

trait ResetInput
{
    public function resetInput()
    {
        foreach ($this->headers as $header) {
            $this->entity->$header = null;
        }

        if ($this->entity->message) {
            $this->entity->message = null;
        }

        if (isset($this->editMode)) {
            $this->editMode = false;
        }

        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
