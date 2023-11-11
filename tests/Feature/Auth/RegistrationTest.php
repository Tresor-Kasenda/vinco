<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Enums\UserStatusEnum;
use App\Enums\UserTypeEnum;
use App\Livewire\Actions\Users\AssignRoleUser;
use App\Livewire\Actions\Users\SubscriptionUser;
use App\Models\University;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Arr;
use Livewire;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test('registration screen can be rendered', function (): void {
    $response = get('/register');

    $response
        ->assertSeeLivewire('auth.register')
        ->assertOk();
});

test('new users can register', function (): void {
    $component = Livewire::test('auth.register')
        ->set('user_type', Arr::random(UserTypeEnum::cases()))
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('password', 'password')
        ->set('password_confirmation', 'password');

    $component->call('register');

    $component->assertRedirect(RouteServiceProvider::HOME);

    $this->assertAuthenticated();
});

it('allows active users to pass the middleware', function (): void {
    $user = User::factory()->create(['status' => UserStatusEnum::ACTIVE]);
    actingAs($user);

    $response = get('/test');

    $response->assertOk();
});

it('redirects inactive users to the login page', function (): void {
    $user = User::factory()->create(['status' => UserStatusEnum::INACTIVE]);
    actingAs($user);

    $response = get('/test');

    $response->assertRedirect('login');
});

it('allows guests to pass the middleware', function (): void {
    $response = get('/test');

    $response->assertOk();
});

test('new users must verify their email address before logging in', function (): void {
    $user = User::factory()->unverified()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertRedirect(RouteServiceProvider::HOME.'?verified=1');
    $this->assertAuthenticated();
});


it('assigns the correct role to the user based on their user type', function (): void {
    $user = User::factory()->create(['user_type' => 'student']);
    $role = Role::factory()->create(['name' => 'student', 'guard_name' => 'web']);

    $assignRoleUser = new AssignRoleUser();
    $assignRoleUser->handle($user, function ($user) use ($role): void {
        $user->assignRole($role);
    });

    expect($user->hasRole('student'))->toBe(1);
});

it('creates the role if it does not exist', function (): void {
    $user = User::factory()->create(['user_type' => 'student']);

    $assignRoleUser = new AssignRoleUser();
    $assignRoleUser->handle($user, function ($user): void {
        $role = Role::query()
            ->firstOrCreate([
                'name' => $user->user_type,
                'guard_name' => 'web'
            ]);
        $user->assignRole($role);
    });

    $this->assertDatabaseHas('roles', ['name' => 'student', 'guard_name' => 'web']);
});

it('calls the next closure after assigning the role', function (): void {
    $user = User::factory()->create(['user_type' => 'student']);
    $role = Role::factory()->create(['name' => 'student', 'guard_name' => 'web']);

    $nextCalled = false;

    $assignRoleUser = new AssignRoleUser();
    $assignRoleUser->handle($user, function ($user) use (&$nextCalled): void {
        $nextCalled = true;
    });

    $this->assertTrue($nextCalled);
});

it('updates the university_id of the user when user type is student', function (): void {
    $user = User::factory()->create(['user_type' => 'student']);
    $university = University::factory()->create(['name' => 'Vinco']);

    $subscriptionUser = new SubscriptionUser();
    $subscriptionUser->handle($user, function ($user) use ($university): void {
        $user->update(['university_id' => $university->id]);
    });

    $this->assertEquals($university->id, $user->fresh()->university_id);
});

it('updates the university_id of the user when user type is not student', function (): void {
    $user = User::factory()->create(['user_type' => 'school_management']);
    $university = University::factory()->create(['name' => 'school_management']);

    $subscriptionUser = new SubscriptionUser();
    $subscriptionUser->handle($user, function ($user) use ($university): void {
        $university->update(['name' => $user->user_type]);
    });

    $this->assertEquals($university->id, $user->fresh()->university_id);
});

it('creates the university if it does not exist', function (): void {
    $user = User::factory()->create(['user_type' => 'student']);

    $subscriptionUser = new SubscriptionUser();
    $subscriptionUser->handle($user, function ($user): void {
        $university = University::query()
            ->firstOrCreate(['name' => UserTypeEnum::USER_STUDENT === $user->user_type ? 'Vinco' : $user->user_type]);
        $user->update(['university_id' => $university->id]);
    });

    $this->assertDatabaseHas('universities', ['name' => 'Vinco']);
});

it('calls the next closure after updating the university_id', function (): void {
    $user = User::factory()->create(['user_type' => 'student']);
    $university = University::factory()->create(['name' => 'Vinco']);

    $nextCalled = false;

    $subscriptionUser = new SubscriptionUser();
    $subscriptionUser->handle($user, function ($user) use (&$nextCalled): void {
        $nextCalled = true;
    });

    $this->assertTrue($nextCalled);
});
