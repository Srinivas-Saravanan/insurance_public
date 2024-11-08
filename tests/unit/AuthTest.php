<?php

declare (strict_types = 1);

namespace tests\unit;

use App\Controllers\Auth;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
class AuthTest extends CIUnitTestCase{
    public function testIndex()
    {
        $con = new Auth();
       $te  = $this->get('home/view',100);

       
    }
       
       

}