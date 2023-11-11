<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.login')]
#[Title("Authentication")]
class Login extends Component
{
    public LoginForm $form;

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.auth.login');
    }

    /**
     * This method is responsible for handling the login process.
     *
     * @return void
     */
    public function login(): void
    {
        // Validate the form data
        $this->validate();

        // Authenticate the user
        $this->form->authenticate();

        // Regenerate the session ID to prevent session fixation attacks
        Session::regenerate();

        // Redirect the user to their intended URL after login, or to the home page if no intended URL is set
        $this->redirect(
            session('url.intended', RouteServiceProvider::HOME),
            navigate: true
        );
    }
}
