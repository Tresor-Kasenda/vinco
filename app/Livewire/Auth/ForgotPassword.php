<?php

namespace App\Livewire\Auth;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.login')]
#[Title('Forgot Password')]
class ForgotPassword extends Component
{
    #[Rule([
        'required',
        'string',
        'email'
    ])]
    public string $email = '';


    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.auth.forgot-password');
    }

    public function sendPasswordResetLink(): void
    {
        $this->validate();

        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));
            return;
        }
        $this->reset('email');

        session()->flash('status', __($status));
    }
}
