<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $locale = $request->route('locale') ?? 'en';
        app()->setLocale($locale);
        
        return view('index', ['locale' => $locale]);
    }

    public function execute(Request $request)
    {
        try {
            $code = $request->input('code', '');
            $result = eval('return ' . $code . ';');
            return response()->json(['success' => true, 'result' => $result]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function clear(Request $request)
    {
        try {
            \Illuminate\Support\Facades\Artisan::call('cache:clear');
            \Illuminate\Support\Facades\Artisan::call('config:clear');
            return response()->json(['success' => true, 'message' => 'Cache cleared']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}