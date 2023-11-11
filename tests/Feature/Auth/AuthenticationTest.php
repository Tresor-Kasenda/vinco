<?php

declare(strict_types=1);

use App\Enums\UserTypeEnum;
use App\Http\Middleware\EnsureUserHasSpecificTypeMiddleware;
use App\Models\User;
use App\Providers\RouteServiceProvider;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test('login screen can be rendered', function (): void {
    $response = get('/login');

    $response
        ->assertSeeLivewire('auth.login')
        ->assertOk();
});

test('users can authenticate using the login screen', function (): void {
    $user = User::factory()->create();

    $component = Livewire::test('auth.login')
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

    $component = Livewire::test('auth.login')
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
        ->assertSeeLivewire('layout.navigation')
        ->assertOk();
});

test('users can logout', function (): void {
    $user = User::factory()->create();

    actingAs($user);

    $component = Livewire::test('layout.navigation');

    $component->call('logout');

    $component
        ->assertHasNoErrors()
        ->assertRedirect('/');

    $this->assertGuest();
});

it('allows student users to pass the middleware and get redirected', function (): void {
    $user = User::factory()->create(['user_type' => UserTypeEnum::USER_STUDENT]);
    actingAs($user);

    $request = Request::create('/dashboard', 'GET');
    $request->setUserResolver(fn () => $user);

    $middleware = new EnsureUserHasSpecificTypeMiddleware();

    $response = $middleware->handle($request, function (): void {
    });

    $this->assertEquals(302, $response->getStatusCode());
    $this->assertEquals(route('home'), $response->headers->get('Location'));
    $this->assertEquals('Welcome to lms learning.', session('danger'));
});

it('allows non-student users to pass the middleware without redirection', function (): void {
    $user = User::factory()->create(['user_type' => UserTypeEnum::USER_SCHOOL_MANAGEMENT]);
    actingAs($user);

    $request = Request::create('/test', 'GET');
    $request->setUserResolver(fn () => $user);

    $middleware = new EnsureUserHasSpecificTypeMiddleware();

    $response = $middleware->handle($request, fn () => new Response());

    $this->assertEquals(200, $response->getStatusCode());
});

it('allows guests to pass the middleware without redirection', function (): void {
    $request = Request::create('/test', 'GET');

    $middleware = new EnsureUserHasSpecificTypeMiddleware();

    $response = $middleware->handle($request, fn () => new Response());

    $this->assertEquals(200, $response->getStatusCode());
});
