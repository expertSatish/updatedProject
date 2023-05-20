<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CountryList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $countries;
    public function __construct()
    {
        $this->countries = \App\Models\Country::where('status',1)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.country-list');
    }
}
