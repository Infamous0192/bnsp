<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\ProductModel;

class Cart extends BaseController
{
  protected $cart, $product;

  public function __construct()
  {
    $this->cart = new CartModel();
    $this->product = new ProductModel();
  }

  public function index()
  {
    return view('user/cart', [
      'title'        => 'Carts',
      'products' => $this->cart->findByUser(1)
    ]);
  }

  public function remove($id)
  {
    $this->cart->delete($id);

    return redirect()->to('/user/cart');
  }

  public function add($id)
  {
    $product = $this->product->find($id);

    $this->cart->insert([
      'id_product' => $product['id'],
      'id_user' => session()->get('id')
    ]);

    return redirect()->to('/user/cart');
  }
}
