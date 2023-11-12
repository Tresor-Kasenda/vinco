<?php

namespace App\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.login')]
#[Title('Confirm Password')]
class ConfirmPassword extends Component
{
    #[Rule([
        'required',
        'string',
    ])]
    public string $password = '';

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.auth.confirm-password');
    }

    /**
     * The confirmPassword method is responsible for validating the user's password and confirming their identity.
     * It first validates the password input.
     * Then, it checks if the provided password matches the logged-in user's password.
     * If the password does not match, it throws a ValidationException with an error message.
     * If the password matches, it sets a session variable 'auth.password_confirmed_at' with the current time.
     * Finally, it redirects the user to the intended URL or the home page if no intended URL is available.
     *
     * @throws ValidationException if the provided password does not match the logged-in user's password.
     * @return void
     */
    public function confirmPassword(): void
    {
        // Validate the password input
        $this->validate();

        // Check if the provided password matches the logged-in user's password
        if (!Auth::guard('web')->validate(['email' => Auth::user()->email, 'password' => $this->password])) {
            // Throw a ValidationException with an error message if the password does not match
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        // Set a session variable 'auth.password_confirmed_at' with the current time
        session(['auth.password_confirmed_at' => time()]);

        // Redirect the user to the intended URL or the home page if no intended URL is available
        $this->redirect(
            session('url.intended', RouteServiceProvider::HOME),
            navigate: true
        );
    }
}
