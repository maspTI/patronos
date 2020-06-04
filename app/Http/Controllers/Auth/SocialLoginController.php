<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectToProvider($provider)
    {
        try {
            return Socialite::driver($provider)->scopes(['email', 'profile', 'openid'])->redirect();
        } catch (Exception $e) {
            return abort(500);
        }
    }

    public function handleProviderCallback($provider)
    {
        try {
            $googleUser = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return abort(500);
        }

        $localUser = User::where('email', $googleUser->getEmail())->first();

        if (explode("@", $googleUser->getEmail())[1] === 'masp.org.br' && !isset($localUser->id)) {
            $localUser = $this->create($googleUser);
        }

        return isset($localUser->id) ? $this->login($localUser, $googleUser) : abort(403, 'Usuário não pretence ao domínio');
    }

    public function login($localUser, $googleUser)
    {
        $localUser->update(['avatar' => $googleUser->getAvatar()]);
        auth()->login($localUser, true);
        return redirect('/');
    }

    public function create($googleUser)
    {
        return User::create(
            [
                'name' => $googleUser->getName(),
                'username' => explode("@", $googleUser->getEmail())[0],
                'email' => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
                'status' => Carbon::now()
            ]
        );
    }
}
