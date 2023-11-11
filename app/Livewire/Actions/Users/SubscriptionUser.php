<?php

declare(strict_types=1);

namespace App\Livewire\Actions\Users;

use App\Enums\UserTypeEnum;
use App\Models\University;
use App\Models\User;
use Closure;

class SubscriptionUser
{
    /**
     * The handle method is responsible for updating the user's university_id.
     * It first checks if the user type is a student, if true, it sets the university name to 'Vinco'.
     * If the user type is not a student, it sets the university name to the user type.
     * It then finds or creates a university with the given name and retrieves its id.
     * The university_id of the user is then updated with the id of the university.
     * After updating the university_id, it passes the user to the next closure.
     *
     * @param User $user The user to update the university_id for.
     * @param Closure $next The next closure to pass the user to.
     * @return mixed The result of the next closure.
     */
    public function handle(User $user, Closure $next): mixed
    {
        $user->update([
            'university_id' => University::query()
                ->firstOrCreate(['name' => UserTypeEnum::USER_STUDENT === $user->user_type ? 'Vinco' : $user->user_type])
                ->id
        ]);

        return $next($user);
    }
}
