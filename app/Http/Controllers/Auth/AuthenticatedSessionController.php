<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */

    /* Função ajustada para ao fazer login voltar para a página que estava */
    public function create(Request $request): View
    {
        // Armazenar a URL anterior na sessão
        if (!auth()->check()) {
            session()->put('url.intended', url()->previous());
        }
    
        return view('auth.login');
    }
    
    /**
     * Handle an incoming authentication request.
     */
        /* Função ajustada para ao fazer login voltar para a página que estava */

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
    
        // Redireciona para a URL anterior ou para a rota padrão
        return redirect()->intended(url()->previous() ?: route('dashboard'));
    }
    
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
