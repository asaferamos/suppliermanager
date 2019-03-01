<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Jobs\SendEmailActivationOfSupplier;
use App\Supplier;

class SupplierController extends Controller
{
    public function store(SupplierRequest $request)
    {
        try{
            $supplier = new Supplier();

            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->monthlypayment = $request->monthlypayment;
            $supplier->company_id = $request->company_id;

            $supplier->save();

            SendEmailActivationOfSupplier::dispatch($supplier);

            return response()->json(array('supplier_id' => $supplier->id), 201);
        }catch (\Exception $e)
        {
            return response()->json($e->getMessage());
        }
    }
}
