<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PrincipalCardComponent extends Component
{
    public $title, $principal_svg, $cant, $secondary_svg, $class;
    /**
     * Create a new component instance.
     */

    public function __construct($title = "", $principal_svg = "", $cant = "", $secondary_svg = "", $class = "")
    {
        if (empty($class)) {
            $this->class = "bg-black/60 p-6 rounded-lg";
        } else {
            $this->class = $class;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.principal-card-component');
    }
}
