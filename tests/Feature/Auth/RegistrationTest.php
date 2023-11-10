<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Enums\UserStatusEnum;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Livewire\Volt\Volt;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test('registration screen can be rendered', function (): void {
    $response = get('/register');

    $response
        ->assertSeeVolt('pages.auth.register')
        ->assertOk();
});

test('new users can register', function (): void {
    $component = Volt::test('pages.auth.register')
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('password', 'password')
        ->set('password_confirmation', 'password');

    $component->call('register');

    $component->assertRedirect(RouteServiceProvider::HOME);

    $this->assertAuthenticated();
});

it('allows active users to pass the middleware', function () {
    $user = User::factory()->create(['status' => UserStatusEnum::ACTIVE]);
    actingAs($user);

    $response = get('/test');

    $response->assertOk();
});

it('redirects inactive users to the login page', function () {
    $user = User::factory()->create(['status' => UserStatusEnum::INACTIVE]);
    actingAs($user);

    $response = get('/test');

    $response->assertRedirect('login');
});

it('allows guests to pass the middleware', function () {
    $response = get('/test');

    $response->assertOk();
});

test('new users must verify their email address before logging in', function (): void {
    $user = User::factory()->unverified()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertRedirect(RouteServiceProvider::HOME . '?verified=1');
    $this->assertAuthenticated();
});

