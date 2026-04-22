<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function create(Request $request)
    {
        $locale = $request->route('locale') ?? 'en';
        app()->setLocale($locale);
        return view('auth.login', ['locale' => $locale]);
    }

    public function store(Request $request)
    {
        $locale = $request->route('locale') ?? 'en';
        app()->setLocale($locale);
        return redirect()->route('home', ['locale' => $locale])->with('success', __('messages.login_success'));
    }

    public function destroy(Request $request)
    {
        $locale = $request->route('locale') ?? 'en';
        app()->setLocale($locale);
        return redirect()->route('home', ['locale' => $locale])->with('success', __('messages.logout_success'));
    }
}