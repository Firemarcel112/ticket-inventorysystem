<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public bool $type;
    public mixed $id;
    public bool $disabled;
    public mixed $colorType;
    public mixed $contentClass;
    public mixed $btnClasses;
    public mixed $jsConfirm;
    public mixed $spanClass;
    public mixed $content;
    public mixed $link;
    public mixed $click;


    /**
     * Create a new component instance.
     *
     * @param string $content
     * @param bool $type
     * @param string $id
     * @param bool $disabled
     * @param string $btnClasses
     * @param string $confirmMessage
     * @param string $spanClass
     * @param string $link
     */
    public function __construct(
        string $content = "Default Button",
        bool   $type = false,
        $click = '',
        string $id = "",
        bool   $disabled = false,
        string $colorType = "primary",
        string $contentClass = "",
        string $btnClasses = "",
        string $jsConfirm = "",
        string $spanClass = "",
        string $link = "",
    )
    {
        $this->content = $content;
        $this->type = $type;
        $this->click = $click;
        $this->id = $id;
        $this->disabled = $disabled;
        $this->colorType = $colorType;
        $this->contentClass = $contentClass;
        $this->btnClasses = $btnClasses;
        $this->jsConfirm = $jsConfirm;
        $this->spanClass = $spanClass;;
        $this->link = $link;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button');
    }
}
