<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class sidebarNavSubMenuComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $href;
    public $title;

    public function __construct($href = "#", $title = "")
    {
        $this->href = $href;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-nav-sub-menu-component');
    }
}
