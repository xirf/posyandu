<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component {
    /**
     * Get the view / contents that represents the component.
     */
    public function __construct(
        public  bool $noNav = false,
    ) {
    }

    public function render(): View {
        return view('layouts.app');
    }
}
