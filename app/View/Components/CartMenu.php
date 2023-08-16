<?php

namespace App\View\Components;

use App\Facades\Cart;
use App\Repositories\Cart\CartRepository;
use Illuminate\View\Component;

class CartMenu extends Component
{
    public $items;
    public $items2;
    public $total;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(CartRepository $cart)
    {
        $this->items = $cart->get()->sortByDesc('updated_at')->take(3);
        $this->items2 = $cart->get()->sortByDesc('updated_at');
        $this->total = $cart->total();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart-menu');
    }
}
