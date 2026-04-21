<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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
        $locale = $request->route('locale') ?? 'en';
        try {
            $code = $request->input('code', 'return "No code provided";');
            $result = eval($code);
            return redirect()->route('home', ['locale' => $locale])->with('success', 'Result: ' . $result);
        } catch (\Exception $e) {
            return redirect()->route('home', ['locale' => $locale])->with('error', $e->getMessage());
        }
    }

    public function clear(Request $request)
    {
        $locale = $request->route('locale') ?? 'en';
        try {
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('view:clear');
            return redirect()->route('home', ['locale' => $locale])->with('success', __('messages.cache_cleared'));
        } catch (\Exception $e) {
            return redirect()->route('home', ['locale' => $locale])->with('error', $e->getMessage());
        }
    }
}