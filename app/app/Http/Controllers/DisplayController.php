<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use Illuminate\Support\Facades\Auth;

class DisplayController extends Controller
{
    public function home()
    {
        $shop = Auth::user()->shop()->get();
        return view('main', ['shop' => $shop]);
    }

    public function shopdetail(Shop $shopdetail)
    {
        return view('shopdetail',[
                'detail' => $shopdetail
            ]);
    }
}
