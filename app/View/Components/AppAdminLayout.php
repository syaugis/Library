<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppAdminLayout extends Component
{
    public $assets;

    /**
     * Create a new component instance.
     */
    public function __construct($assets = [],)
    {
        $this->assets = $assets;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.layouts.app');
    }
}
