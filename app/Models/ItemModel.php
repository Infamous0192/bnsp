<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
  protected $table            = 'items';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $protectFields    = true;
  protected $allowedFields    = ['id_transaction', 'id_product'];

  // Validation
  protected $validationRules      = [];
  protected $validationMessages   = [];
  protected $skipValidation       = false;
  protected $cleanValidationRules = true;
}
