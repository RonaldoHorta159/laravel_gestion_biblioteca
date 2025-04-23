<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    //
    // Redirige a Google para iniciar sesión
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    // Maneja la respuesta de Google después de la autenticación
    public function handleGoogleCallback()
    {
        // Obtén el usuario de Google
        $userGoogle = Socialite::driver('google')->stateless()->user();

        // Depuración: Verifica qué contiene el objeto $userGoogle
        // Esto imprimirá los datos del usuario y detendrá la ejecución

        // Si todo está correcto, deberías obtener los datos del usuario de Google
        $fecha = Carbon::now();
        $user = User::updateOrCreate(
            [
                'google_id' => $userGoogle->id,
            ],
            [
                'name' => $userGoogle->name,
                'email' => $userGoogle->email,
                'password' => bcrypt('957782190'), // Cambia esto por una contraseña generada o un hash
                'email_verified_at' => $fecha,
                'google_token' => $userGoogle->token,
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');
    }


}
