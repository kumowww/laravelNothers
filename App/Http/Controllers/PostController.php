<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $locale = $request->route('locale', 'en');
        return view('index', ['locale' => $locale]);
    }

    public function execute(Request $request)
    {
        return back();
    }

    public function clear(Request $request)
    {
        return back();
    }
}