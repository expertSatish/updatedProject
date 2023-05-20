<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DataNotFound extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public function __construct($data=null)
    {
        $this->type = $data ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.data-not-found');
    }
}
