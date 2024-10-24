<?php

namespace App\Filters;

use App\Models\FamilyModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class EmpFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->has('loggedEmp')){
            $username = session()->get('loggedEmp');
            $model = new FamilyModel();
            $code = $model->where('name',$username)->where('relationship','self')->first();
            $familyCode = (int)$code['familyCode'];

            return redirect()->to(base_url('home/view/'.esc($familyCode)))->withInput('fail','You do not have access to this page.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}