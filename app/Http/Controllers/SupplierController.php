<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    function index(){
        $suppliers = Supplier::all();
        return view('AdminDashboard.Supplier.index', compact('suppliers'));
    }
}
