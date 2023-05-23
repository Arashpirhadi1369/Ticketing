<?php

namespace App\Traits;

trait ResetInput
{
    public function resetInput()
    {
        foreach ($this->headers as $header) {
            $this->entity->$header = null;
        }
        if (isset($this->inputs)) {
            $this->inputs = [];
            $this->inputs1 = [];
            $this->item = [];
            $this->amount = [];
            $this->price = [];
            $this->essential = [];
            $this->quantity = [];
            $this->product = [];
            $this->i = 0;
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
