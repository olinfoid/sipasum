<?php

namespace App\Http\Controllers\Frontend\tentang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConTentang extends Controller
{
    public function index()
    {
        return view('frontend.pages.tentang.index');
    }
}
