<?php

namespace App\Models;

use CodeIgniter\Model;

class RuleModel extends Model
{

    protected $DBGroup = "default";

    protected $table = "family_rules";

    protected $allowedFields = ['familyCode','rules'];

}