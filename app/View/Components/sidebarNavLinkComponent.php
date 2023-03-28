<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Ramsey\Uuid\Type\Integer;

class sidebarNavLinkComponent extends Component
{
    /**
     * Create a new component instance.
     */

    public $svg;
    public $class;
    public $enlace_class;
    public $notification;
    public $href;
    public function __construct(
        string $svg = "",
        string $class = "flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center",
        string $enlace_class = "",
        int $notification = 0,
        $href = "#"
    ) {
        $this->class = $class;
        $this->href = $href;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-nav-link-component');
    }
}
