<?php

namespace App\Controllers\Admin;

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
    return view('admin/transaction', [
      'title'        => 'Transactions',
      'transactions' => $this->transaction->join('users', 'transactions.id_user=users.id')->select('transactions.id, users.name, transactions.status')->findAll()
    ]);
  }

  public function detail($id)
  {
    $transaction = $this->transaction->find($id);
    $products = $this->item->where('id_transaction', $transaction['id'])->join('products', 'products.id=items.id_product')->findAll();

    return view('user/transaction-detail', [
      'title' => 'Transaction detail',
      'transaction' => $transaction,
      'products' => $products
    ]);
  }

  public function bayar($id)
  {
    $this->transaction->update($id, [
      'status' => 'terbayar'
    ]);

    return redirect()->back();
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

    $this->item->insertBatch($items);

    return redirect()->to('/user/transaction');
  }
}
