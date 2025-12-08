<?php

namespace App\Http\Controllers\Table;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        // Logic hiển thị menu gọi món cho khách tại bàn
        return view('table.dashboard');
    }
}
