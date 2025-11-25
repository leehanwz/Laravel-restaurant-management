<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AppLayout extends Component
{
    public $user;

    public function __construct()
    {
        $this->user = Auth::user(); // truyền thông tin user vào view
    }

    public function render(): View
    {
        return view('layouts.app'); // Blade sẽ dùng $user để hiển thị role, menu...
    }
}
