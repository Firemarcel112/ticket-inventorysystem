<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarItem extends Component
{
    public mixed $route;
    public mixed $icon;
    public mixed $name; 
    public int $dropdown;
    public mixed $menuID;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $name,
        $route = '',
        $icon = 'dashboard',
        $dropdown = 0,
        $menuID = ''
    )
    {
        $this->name = $name;
        $this->route = $route;
        $this->icon = $icon;
        $this->dropdown = $dropdown;
        $this->menuID = $menuID;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar-item');
    }
}
