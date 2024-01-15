<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {

        return view('auth.login');
    }

    public function adminCreate(): View
    {

        return view('admin.login');
    }
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $guard = $request->segments()[1] == 'admin' ? 'admin' : 'web';
        $request->authenticate($guard);

        $request->session()->regenerate();
        if ($guard == 'admin') {
            return redirect()->intended(App::getLocale() . RouteServiceProvider::ADMIN_HOME);
        }
        return redirect()->intended(App::getLocale() . RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard(Auth::getDefaultDriver())->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }
        return redirect('/');
    }
}
