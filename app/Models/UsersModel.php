<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{

    protected $DBGroup = "default";

    protected $table = "users";

    protected $allowedFields = ['username','password','role'];

}