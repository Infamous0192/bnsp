<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table            = 'users';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $protectFields    = true;
  protected $allowedFields    = ['name', 'username', 'password', 'role'];

  // Validation
  protected $validationRules      = [];
  protected $validationMessages   = [];
  protected $skipValidation       = false;
  protected $cleanValidationRules = true;
}
