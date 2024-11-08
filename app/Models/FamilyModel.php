<?php

namespace App\Models;

use CodeIgniter\Model;

class FamilyModel extends Model
{

    protected $DBGroup = "default";

    protected $table = "family_list";

    protected $allowedFields = ['name','gender','dob','relationship','familyCode'];

   
}