<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class AdminSupplierController extends Controller
{
    /**
     * admin/supplier/index
     */
    public function index()
    {
        $suppliers = Supplier::all();

        return view('admin.supplier.index', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name'=>'required']);

        Supplier::create($data);

        return back();

    }

    public function edit(Supplier $supplier)
    {
        return view('admin.supplier.edit', compact('supplier'));
    }

 
    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate(['name'=>'required']);

        $supplier->update($data);

        return redirect()->route('admin.supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
