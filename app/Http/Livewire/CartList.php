<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CartList extends Component
{
    public $carts = [];
    protected $listeners = ['cartAdded' => 'getCartItem'];
    public function mount()
    {
        $this->getCartItem();
    }

    public function getCartItem()
    {
        $this->carts = \Session::get('productItem');
        if (empty($this->carts)) {
            $this->carts = [];
        }
    }

    public function removeCartItem($index)
    {
        $carts = \Session::get('productItem');
        unset($carts[$index]);
        $carts = array_values($carts);
        session(['productItem' => $carts]);
        $this->getCartItem();
        $this->emitTo('nav-bar', 'badgeCount');
    }

    public function render()
    {
        return view('livewire.cart-list');
    }
}
