<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Admin\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin::pages.auth');
    }

    /**
     * @param AuthRequest $authRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(AuthRequest $authRequest)
    {
        $credentials = $authRequest->all(['email', 'password']);

        if (Auth::guard('web')->attempt($credentials)) {
            $authRequest->session()->regenerate();

            return redirect()->intended('admin');
        }

        return back()->withErrors([
            'The provided credentials do not match our records.',
        ]);
    }
}
