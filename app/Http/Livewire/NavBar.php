<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class NavBar extends Component
{
    public $cartCount = 0;
    protected $listeners = ['badgeCount' => 'getCartCount'];

    public function mount()
    {
        $this->getCartCount();
    }

    public function getCartCount()
    {
        $carts = \Session::get('productItem');
        // Log::info(empty($carts));
        if (empty($carts)) {
            $carts = [];
        }
        $this->cartCount = count($carts);
    }

    public function render()
    {
        return view('livewire.nav-bar');
    }
}
