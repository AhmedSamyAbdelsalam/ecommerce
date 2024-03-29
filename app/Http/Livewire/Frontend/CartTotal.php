<?php

namespace App\Http\Livewire\Frontend;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartTotal extends Component
{
    public $cart_subtotal;
    public $cart_tax;
    public $cart_total;
    public $cart_discount;
    public $cart_shipping;

    protected $listeners = [
      'updateCart'=>'mount'
    ];

    public function mount()
    {
        $this->cart_subtotal = getNumbers()->get('subtotal');
        $this->cart_tax = getNumbers()->get('productTaxes');
        $this->cart_total = getNumbers()->get('total');
        $this->cart_discount = getNumbers()->get('discount');
        $this->cart_shipping = getNumbers()->get('shipping');
    }
    public function render()
    {
        return view('livewire.frontend.cart-total');
    }
}
