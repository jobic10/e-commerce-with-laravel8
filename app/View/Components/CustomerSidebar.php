<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;

class CustomerSidebar extends Component
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
        $now = date('Y-m-d');
        $products = Product::where('date_view', $now)->orderBy('counter', 'DESC')->limit(10)->get();
        return view('components.customer-sidebar', ['products' => $products]);
    }
}