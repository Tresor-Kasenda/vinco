<?php

namespace App\Livewire\Actions\Users;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RedirectUser
{
    /**
     * The handle method is responsible for logging in a newly registered user and redirecting them to the home page.
     * It first fires a Registered event for the user.
     * Then, it logs the user in using Laravel's Auth facade.
     * Finally, it redirects the user to the home page defined in RouteServiceProvider.
     *
     * @param mixed $user The user to log in and redirect.
     * @param Closure $next The next closure in the pipeline.
     * @return RedirectResponse The response that should be returned by the middleware.
     */
    public function handle(mixed $user, Closure $next): RedirectResponse
    {
        // Fire a Registered event for the user
        event(new Registered($user));

        // Log the new user in
        Auth::login($user);

        // Redirect the user to the home page
        return redirect(RouteServiceProvider::HOME);
    }
}
