<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class Checkbox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public mixed $label;
    public mixed $inputName;
    public mixed $value;
    public bool $setRequired;

    public function __construct(
        $label,
        $inputName,
        $value = false,
        $setRequired = false
    )
    {
        $this->label = $label;
        $this->inputName = $inputName;
        $this->value = $value;
        $this->setRequired = $setRequired;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.checkbox');
    }
}
