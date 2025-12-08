<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        // Trả về view dashboard của thu ngân
        return view('cashier.dashboard');
    }
}
