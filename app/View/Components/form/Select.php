<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class Select extends Component
{
    public mixed $label;
    public mixed $inputName;
    public mixed $array;
    public mixed $compare;
    public mixed $visibleValue;
    public mixed $visibleValue2;
    public mixed $hiddenOption;
    public mixed $skipValue;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $label,
        $inputName,
        $array,
        $compare,
        $visibleValue,
        $visibleValue2 = "",
        $hiddenOption = "",
        $skipValue = "",
    )
    {
        $this->label = $label;
        $this->inputName = $inputName;
        $this->array = $array;
        $this->compare = $compare;
        $this->visibleValue = $visibleValue;
        $this->visibleValue2 = $visibleValue2;
        $this->hiddenOption = $hiddenOption;
        $this->skipValue = $skipValue;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.select');
    }
}
