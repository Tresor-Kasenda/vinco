<?php

namespace App\Http\Middleware;

use App\Enums\UserStatusEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isUserInactive($request)) {
            $this->logoutAndRedirect($request);
        }
        return $next($request);
    }

    /**
     * Checks if the user is inactive.
     *
     * This method checks if the user associated with the request is inactive.
     * A user is considered inactive if their status is not equal to 'ACTIVE'.
     *
     * @param Request $request The incoming HTTP request.
     * @return bool Returns true if the user is inactive, false otherwise.
     */
    private function isUserInactive(Request $request): bool
    {
        return $request->user() && UserStatusEnum::ACTIVE !== $request->user()->status;
    }

    /**
     * Logs out the user and redirects them to the login page.
     *
     * This method logs out the user associated with the request, invalidates their session,
     * regenerates the session token, and then redirects them to the login page.
     * A message is also flashed to the session to inform the user that their account is not activated.
     *
     * @param Request $request The incoming HTTP request.
     * @return Response The response object with the redirection.
     */
    private function logoutAndRedirect(Request $request): Response
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('danger', 'Your account is not activated.');
    }
}
