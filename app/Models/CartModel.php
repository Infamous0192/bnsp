<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
  protected $table            = 'carts';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $protectFields    = true;
  protected $allowedFields    = ['id_user', 'id_product'];

  // Validation
  protected $validationRules      = [];
  protected $validationMessages   = [];
  protected $skipValidation       = false;
  protected $cleanValidationRules = true;

  public function findByUser($id)
  {
    return $this->where('id_user', $id)->join('products', 'carts.id_product=products.id')->select('carts.id, title, id_product, description, price, thumbnail')->findAll();
  }
}
