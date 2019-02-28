<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Supplier;

class SupplierController extends Controller
{
    public function store(SupplierRequest $request)
    {
        $supplier = new Supplier();

        $supplier->name  = $request->name;
        $supplier->email = $request->email;
        $supplier->monthlypayment = $request->monthlypayment;
        $supplier->company_id     = $request->company_id;

        $supplier->save();

        return response()->json(array('supplier_id' => $supplier->id), 201);
    }
}
