<?php

namespace App\Http\Livewire;

use App\Models\Addon;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ProductList extends Component
{
    public $addons;
    public $products;
    public $productItem;
    public $cart = [];

    public function updatedProductItem()
    {
        $this->productItem = $this->productItem;
    }

    public function addAddonInProduct($item)
    {
        if (isset($this->productItem['addons'])) {
            $addons = $this->productItem['addons'];
            $found = false;
            foreach ($addons as $key => $addon) {
                if ($addon['id'] === $item['id']) {
                    $addons[$key]['quantity']++;
                    $addons[$key]['total_price'] += $addons[$key]['price'];
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $item['quantity'] = 1;
                $item['total_price'] = $item['price'];
                array_push($addons, $item);
            }
            $this->productItem['addons'] = $addons;
        } else {
            $item['quantity'] = 1;
            $item['total_price'] = $item['price'];
            $this->productItem['addons'] = [$item];
        }
    }

    public function productItemIncrement()
    {
        if ($this->productItem->isNotEmpty()) {
            $this->productItem['quantity'] = $this->productItem['quantity'] + 1;
            $this->productItem['total_price'] = $this->productItem['total_price'] + $this->productItem['price'];
        }
    }

    public function productItemDecrement()
    {
        if ($this->productItem->isNotEmpty()) {
            if ($this->productItem['quantity'] > 1) {
                $this->productItem['quantity'] = $this->productItem['quantity'] - 1;
                $this->productItem['total_price'] = $this->productItem['total_price'] - $this->productItem['price'];
            }
        }
    }

    public function selectProduct($item)
    {
        $item['quantity'] = 1;
        $item['total_price'] = $item['price'];
        $this->productItem = collect($item);
        if ($item['is_addon'] == true || $item['is_addon'] == 1) {
            $this->dispatchBrowserEvent('show-modal');
        } else {
            $this->addToCart();
        }
    }

    public function removeAddonItem($index)
    {
        if (isset($this->productItem['addons'])) {
            $addons = $this->productItem['addons'];

            if (isset($addons[$index])) {
                if ($addons[$index]['quantity'] == 1) {
                    unset($addons[$index]);
                } else {
                    $addons[$index]['quantity']--;
                    $addons[$index]['total_price'] -= $addons[$index]['price'];
                }

                $addons = array_values($addons);

                $this->productItem['addons'] = $addons;
            }
        }
    }

    public function addToCart()
    {
        $carts = \Session::get('productItem');
        if (empty($carts)) {
            $carts = [];
        }
        array_push($carts, $this->productItem);
        session(['productItem' => $carts]);
        $this->emitTo('cart-list', 'cartAdded');
        $this->emitTo('nav-bar', 'badgeCount');
    }

    public function abs($item)
    {
        Log::debug($item);
        $item['quantity'] = 1;
        $item['total_price'] = $item['price'];
        $this->productItem = $item;
        // $this->selectProduct($item, false);
        $this->addToCart();
    }

    public function mount()
    {
        session()->start();
    }

    public function render()
    {
        $this->products = Product::get();
        $this->addons = Addon::get();
        return view('livewire.product-list');
    }
}
