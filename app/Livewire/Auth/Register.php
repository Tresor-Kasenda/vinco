<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Enums\UserTypeEnum;
use App\Livewire\Actions\Users\AssignRoleUser;
use App\Livewire\Actions\Users\RedirectUser;
use App\Livewire\Actions\Users\SubscriptionUser;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.login')]
#[Title("Registration")]
class Register extends Component
{
    #[Rule([
        'required',
        'string',
        'max:255',
        new Enum(UserTypeEnum::class)
    ])]
    public string $user_type = '';
    #[Rule([
        'required',
        'string',
        'max:255'
    ])]
    public string $name = '';
    #[Rule([
        'required',
        'string',
        'lowercase',
        'email',
        'max:255',
        'unique:'.User::class
    ])]
    public string $email = '';
    #[Rule([
        'required',
        'string',
        'confirmed'
    ])]
    public string $password = '';

    #[Rule([
        'required',
        'string'
    ])]
    public string $password_confirmation = '';

    /**
     * @var array $pipeline
     *
     * This protected property holds an array of class names that represent the pipeline of actions to be performed when a user registers.
     * The pipeline is processed in the order the classes are listed in the array.
     *
     * - AssignRoleUser::class: This class is responsible for assigning a role to the user based on their user type.
     * - SubscriptionUser::class: This class is responsible for handling the user's subscription.
     * - RedirectUser::class: This class is responsible for redirecting the user after successful registration.
     */
    protected array $pipeline = [
        AssignRoleUser::class,
        SubscriptionUser::class,
        RedirectUser::class
    ];

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.auth.register');
    }


    /**
     * The register method is responsible for registering a new user.
     * It first validates the user input, then hashes the password for security purposes.
     * After that, it creates a new user with the validated data and sends the user through a pipeline of actions.
     * The pipeline includes assigning a role to the user, handling the user's subscription, and redirecting the user after successful registration.
     *
     * @return mixed The result of the pipeline.
     */
    public function register(): mixed
    {
        // Validate the user input
        $validated = $this->validate();

        // Hash the password for security
        $validated['password'] = Hash::make($validated['password']);

        // Create a new user with the validated data
        $user = User::create($validated);

        // Send the user through a pipeline of actions
        return Pipeline::send($user)
            ->through($this->pipeline)
            ->thenReturn();
    }
}
