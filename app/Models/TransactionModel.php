<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
  protected $table            = 'transactions';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $protectFields    = true;
  protected $allowedFields    = ['id_user', 'status'];

  // Validation
  protected $validationRules      = [];
  protected $validationMessages   = [];
  protected $skipValidation       = false;
  protected $cleanValidationRules = true;

  public function findByUser($id)
  {
    return $this->where('id_user', $id)->findAll();
  }
}
