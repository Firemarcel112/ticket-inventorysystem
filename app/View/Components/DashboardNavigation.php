<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DashboardNavigation extends Component
{

    public mixed $headline;
    public mixed $searchPlaceholder;
    public mixed $createRoute;
    public mixed $createTitle;
    public bool $qrcode;
    public bool $create;
    public bool $delete;
    public bool $csv;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $headline,
        $searchPlaceholder,
        $createRoute = '',
        $createTitle = '',
        $create = true,
        $qrcode = false,
        $csv = false,
        $delete = false,
    )
    {
        $this->headline = $headline;
        $this->searchPlaceholder = $searchPlaceholder;
        $this->createRoute = $createRoute;
        $this->createTitle = $createTitle;
        $this->qrcode = $qrcode;
        $this->create = $create;
        $this->csv = $csv;
        $this->delete = $delete;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard-navigation');
    }
}
