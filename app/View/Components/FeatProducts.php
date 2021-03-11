<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;

class FeatProducts extends Component
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
        $data['fProducts'] = Product::select('*')->where('quantity', '>' , '0')->orderBy('id', 'DESC')->limit(5)->active()->get();
        return view('components.feat-products')->with($data);
    }
}
