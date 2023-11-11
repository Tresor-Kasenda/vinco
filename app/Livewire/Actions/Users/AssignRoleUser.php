<?php

declare(strict_types=1);

namespace App\Livewire\Actions\Users;

use App\Models\User;
use Closure;
use Spatie\Permission\Models\Role;

class AssignRoleUser
{
    /**
     * The handle method is responsible for assigning a role to a user based on their user type.
     * It first checks if the user type is a student, if true, it assigns the student role to the user.
     * If the user type is not a student, it assigns the school management role to the user.
     * After assigning the role, it passes the user to the next closure.
     *
     * @param User $user The user to assign the role to.
     * @param Closure $next The next closure to pass the user to.
     * @return mixed The result of the next closure.
     */
    public function handle(User $user, Closure $next): mixed
    {
        // Find or create the role based on the user type
        $role = Role::query()
            ->firstOrCreate([
                'name' => $user->user_type,
                'guard_name' => 'web'
            ]);

        // Assign the role to the user
        $user->assignRole($role);

        // Pass the user to the next closure
        return $next($user);
    }
}
