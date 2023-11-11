<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Enums\UserTypeEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasUniversityTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->shouldRedirectToProcessIndex($request)) {
            session()->flash('danger', 'Please set your school of operation first.');
            return to_route('process.index');
        }
        return $next($request);
    }

    /**
     * Determines if the user should be redirected to the 'process.index' route.
     *
     * This method checks if the authenticated user's university_id is null,
     * if the user's type is 'USER_SCHOOL_MANAGEMENT', and if the user has the 'super-admin' role.
     * If all these conditions are met, the user should be redirected to the 'process.index' route.
     *
     * @param Request $request The incoming HTTP request.
     * @return bool Returns true if the user should be redirected, false otherwise.
     */
    private function shouldRedirectToProcessIndex(Request $request): bool
    {
        return Auth::check() && null === Auth::user()->university_id &&
            UserTypeEnum::USER_SCHOOL_MANAGEMENT === $request->user()->user_type &&
            request()->user()->hasRole('super-admin');
    }
}
