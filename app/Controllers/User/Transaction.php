<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\ItemModel;
use App\Models\ProductModel;
use App\Models\TransactionModel;

class Transaction extends BaseController
{
  protected $cart, $product, $item, $transaction;

  public function __construct()
  {
    $this->cart = new CartModel();
    $this->product = new ProductModel();
    $this->item = new ItemModel();
    $this->transaction = new TransactionModel();
  }

  public function index()
  {
    return view('user/transaction', [
      'title'        => 'Carts',
      'transaction' => $this->transaction->findByUser(session()->get('id'))
    ]);
  }

  public function detail($id)
  {
    // $transaction = 

    return view('user/transaction', [
      'title' => 'Transaction detail',
      'transaction' => $this->transaction->find($id),
      'carts' => $this->cart->findByUser(session()->get())
    ]);
  }

  public function checkout()
  {
    $transactionID = $this->transaction->insert([
      'id_user' => session()->get('id'),
      'status'  => 'pending'
    ],  true);

    $carts = $this->cart->findByUser(session()->get('id'));
    $items = [];
    foreach ($carts as $cart) {
      $items[] = [
        'id_transaction' => $transactionID,
        'id_product' => $cart['id_product']
      ];
    }

    $this->cart->insertBatch($carts);

    return redirect()->to('/user/cart');
  }
}
