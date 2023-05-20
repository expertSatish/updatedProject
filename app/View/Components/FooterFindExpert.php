<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FooterFindExpert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $lists;
    public function __construct(){
        $this->lists = \App\Models\CallingProcess::where('is_publish',1)->orderBy('sequence','ASC')->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.footer-find-expert');
    }
}
