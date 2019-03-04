<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Jobs\SendEmailActivationOfSupplier;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

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
            $supplier->hashactivation = Hash::make($request->email);

            $supplier->save();

            SendEmailActivationOfSupplier::dispatch($supplier);

            return response()->json(array('supplier_id' => $supplier->id), 201);
        }catch (\Exception $e)
        {
            return response()->json($e->getMessage());
        }
    }

    public function activate($token, $supplier)
    {
        try {
            $supplier = Supplier::find($supplier);

            if(!$supplier)
                return response()->json(array('invalid token'), 400);

            if (Hash::check($supplier->email, $token) && $supplier->hashactivation == $token) {
                $supplier->hashactivation = false;

                $supplier->save();

                return response()->json(array('supplier_id' => $supplier->id), 200);
            } else {
                return response()->json(array('invalid token'), 400);
            }
        }catch (\Exception $e){
            return response()->json($e->getMessage());
        }
    }
}
