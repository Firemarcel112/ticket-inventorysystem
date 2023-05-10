<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class Textarea extends Component
{
    public mixed $label;
    public mixed $inputName;
    public mixed $placeholder;
    public mixed $value;
    public mixed $subText;
    public bool $setRequired;
    public mixed $customClasses;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $label,
        $inputName,
        $placeholder,
        $value = "",
        $subText = "",
        $setRequired = false,
        $customClasses = ""
    )
    {
        $this->label = $label;
        $this->inputName = $inputName;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->subText = $subText;
        $this->setRequired = $setRequired;
        $this->customClasses = $customClasses;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.textarea');
    }
}
