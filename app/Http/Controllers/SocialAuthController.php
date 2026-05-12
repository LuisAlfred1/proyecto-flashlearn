<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    //Redirige al usuario a Google.
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    //Google regresa aquí con los datos del usuario.
    public function callback(): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate(
            ['google_id' => $googleUser->getId()],
            [
                'name'   => $googleUser->getName(),
                'email'  => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
            ]
        );

        Auth::login($user, remember: true);

        //Actualmente redirige a /flashcards porque el usuario inició sesión. Si se quiere redirigir al home después del login, cambiar por: return redirect('/');
        return redirect('/flashcards');
    }

    //Cierra sesión.
    public function logout(): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        //Actualmente redirige al home después de cerrar sesión. Si se quiere redirigir a /flashcards, cambiar por: return redirect('/flashcards');
        return redirect('/');
    }
}