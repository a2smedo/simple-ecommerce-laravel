<?php

namespace App\View\Components;


use App\Models\Department;
use Illuminate\View\Component;

class HeaderNav extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $data['departments'] = Department::select('id', 'name')->active()->get();
        return view('components.header-nav')->with($data);
    }
}
