<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ShowProuduct extends Component
{
    use LivewireAlert;
    public $product ;
    public $quantity = 1 ;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function decreaseQuantity()
    {
        if ($this->quantity >1 ) {
            $this->quantity--;
        }
    }

    public function increaseQuantity()
    {
        if ($this->product->quantity > $this->quantity) {
            $this->quantity++;
        }
    }

    public function addToCart()
    {
        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) {
            return $cartItem->id === $this->product->id;
        });
        if ($duplicates->isNotEmpty()) {
            $this->alert('error', 'Product already exist!');
        } else {
            Cart::instance('default')->add($this->product->id, $this->product->name, $this->quantity, $this->product->price)->associate(Product::class);
            $this->quantity = 1;
            $this->emit('updateCart');
            $this->alert('success', 'Product added in your cart successfully.');
        }
    }

    public function addToWishList()
    {
        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) {
            return $cartItem->id === $this->product->id;
        });
        if ($duplicates->isNotEmpty()) {
            $this->alert('error', 'Product already exist!');
        } else {
            Cart::instance('wishlist')->add($this->product->id, $this->product->name, 1, $this->product->price)->associate(Product::class);
            $this->emit('updateCart');
            $this->alert('success', 'Product added in your wishlist cart successfully.');
        }

    }

    public function render()
    {
        return view('livewire.frontend.show-prouduct');
    }
}