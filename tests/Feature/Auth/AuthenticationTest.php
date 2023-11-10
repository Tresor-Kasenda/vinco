<?php

declare(strict_types=1);

use App\Enums\UserTypeEnum;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Livewire\Volt\Volt;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test('login screen can be rendered', function (): void {
    $response = get('/login');

    $response
        ->assertSeeVolt('pages.auth.login')
        ->assertOk();
});

test('users can authenticate using the login screen', function (): void {
    $user = User::factory()->create();

    $component = Volt::test('pages.auth.login')
        ->set('form.email', $user->email)
        ->set('form.password', 'password');

    $component->call('login');

    $component
        ->assertHasNoErrors()
        ->assertRedirect(RouteServiceProvider::HOME);

    $this->assertAuthenticated();
});

test('users can not authenticate with invalid password', function (): void {
    $user = User::factory()->create();

    $component = Volt::test('pages.auth.login')
        ->set('form.email', $user->email)
        ->set('form.password', 'wrong-password');

    $component->call('login');

    $component
        ->assertHasErrors()
        ->assertNoRedirect();

    $this->assertGuest();
});

test('navigation menu can be rendered', function (): void {
    $user = User::factory()->create();

    actingAs($user);

    $response = get('/dashboard');

    $response
        ->assertSeeVolt('layout.navigation')
        ->assertOk();
});

test('users can logout', function (): void {
    $user = User::factory()->create();

    actingAs($user);

    $component = Volt::test('layout.navigation');

    $component->call('logout');

    $component
        ->assertHasNoErrors()
        ->assertRedirect('/');

    $this->assertGuest();
});


it('allows student users to pass the middleware and get redirected', function () {
    $user = User::factory()->create(['user_type' => UserTypeEnum::USER_STUDENT]);
    actingAs($user);

    $response = get('/dashboard');

    $response->assertRedirect('home');
    $response->assertSessionHas('danger', 'Welcome to lms learning.');
});

it('allows non-student users to pass the middleware without redirection', function () {
    $user = User::factory()->create(['user_type' => UserTypeEnum::USER_SCHOOL_MANAGEMENT]);
    actingAs($user);

    $response = get('/test');

    $response->assertOk();
});

it('allows guests to pass the middleware without redirection', function () {
    $response = get('/test');

    $response->assertOk();
});
