<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $locale = $request->route('locale') ?? 'en';
        app()->setLocale($locale);
        
        return view('products.index', ['locale' => $locale]);
    }
}