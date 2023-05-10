<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class Input extends Component
{
    public mixed $label;
    public mixed $inputName;
    public mixed $inputType;
    public mixed $placeholder;
    public mixed $value;
    public mixed $subText;
    public bool $showSubText;
    public bool $setRequired;
    public mixed $patternValue;
    public mixed $extra;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $label,
        $inputName,
        $inputType,
        $placeholder,
        $value = "",
        $subText = "",
        $showSubText = false,
        $setRequired = false,
        $patternValue = "",
        $extra = ""
    )
    {
        $this->label = $label;
        $this->inputName = $inputName;
        $this->inputType = $inputType;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->subText = $subText;
        $this->showSubText = $showSubText;
        $this->setRequired = $setRequired;
        $this->patternValue = $patternValue;
        $this->extra = $extra;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.input');
    }
}
