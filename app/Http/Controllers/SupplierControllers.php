<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;


class SupplierControllers extends Controller
{
    public function index(){
        $suppliers = Supplier::all();
        return view('AdminDashboard.Supplier.index', compact('suppliers'));
        
    }

    public function create(){
        return view('AdminDashboard.Supplier.create');

    }

    public function store(StoreSupplierRequest $request){
        $supplier = Supplier::create($request->validated());
        return redirect()->route('supplier.index')->with('success','Supplier created successfully');
    }

    public function edit($supplier_id){
        $supplier = Supplier::where('id', $supplier_id)->first();
        return view('AdminDashboard.Supplier.edit', compact('supplier'));
    }

    public function update(UpdateSupplierRequest $request, $supplier_id){
        $supplier = Supplier::where('id', $supplier_id)->first();
        $supplier->update($request->validated());
        return redirect()->route('supplier.index')->with('success','Supplier updated successfully');
    }

    public function delete($supplier_id){
        $supplier = Supplier::where('id', $supplier_id)->first();
        $supplier->delete();
        return redirect()->route('supplier.index')->with('success','Supplier deleted successfully');

    }
}
