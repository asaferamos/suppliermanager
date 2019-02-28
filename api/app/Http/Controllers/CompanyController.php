<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Company;

class CompanyController extends Controller
{

    public function store(CompanyRequest $request)
    {

        $company = new Company;
        $company->name    = $request->name;
        $company->phone   = $request->phone;
        $company->address = $request->address;
        $company->cep     = $request->cep;
        $company->cnpj    = $request->cnpj;

        $company->save();

        return response()->json(array('success' => true, $company), 201);
    }
}
