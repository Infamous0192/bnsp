<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class Product extends BaseController
{
  protected $product;

  public function __construct()
  {
    $this->product = new ProductModel();
  }

  public function index()
  {
    return view('user/product', [
      'title'        => 'Products',
      'products' => $this->product->findAll()
    ]);
  }

  public function add()
  {
    return view('user/product-add', [
      'title'        => 'Add Product',
      'validation'     => \Config\Services::validation()
    ]);
  }
}
