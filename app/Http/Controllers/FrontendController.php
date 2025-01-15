<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logo;

class FrontendController extends Controller
{
    public function index()
    {
        $this->logos = Logo::where('status', 1)->get();

        return view('frontend.home.index', ['logos' => $this->logos]);
    }
}
