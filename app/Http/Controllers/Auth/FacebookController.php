<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Socialite;

class FacebookController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleCallback()
    {
        try {
            // Retrieve the user's information from Facebook
            $user = Socialite::driver('facebook')->user();

            // Check if a user already exists with the same social_id, if not, create a new user
            $finduser = User::firstOrCreate(
                ['social_id' => $user->id],
                [
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_type' => 'facebook',
                    'password' => encrypt('my-facebook')
                ]
            );

            // Log the user in
            Auth::login($finduser);

            // Redirect the user to the home page
            return redirect('/home');
        } catch (Exception $e) {
            // Redirect the user back to the login page with an error message if any exceptions occur
            return redirect()->route('login')->withErrors([
                'social' => 'Unable to login with Facebook'
            ]);
        }
    }
}
