<?php

namespace App\Http\Middleware;

use App\Enums\UserTypeEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasSpecificTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isStudent($request)) {
            $this->redirectToHomeWithMessage();
        }

        return $next($request);
    }

    /**
     * Checks if the user is a student.
     *
     * This method checks if the user associated with the request is a student.
     * A user is considered a student if their user_type is equal to 'USER_STUDENT'.
     *
     * @param Request $request The incoming HTTP request.
     * @return bool Returns true if the user is a student, false otherwise.
     */
    private function isStudent(Request $request): bool
    {
        return UserTypeEnum::USER_STUDENT->value === $request->user()->user_type;
    }

    /**
     * Redirects the user to the home page with a flash message.
     *
     * This method flashes a 'danger' message to the session and then redirects the user to the home page.
     * The flashed message will be available on the next HTTP request and then will be deleted.
     *
     * @return Response The response object with the redirection.
     */
    private function redirectToHomeWithMessage(): Response
    {
        session()->flash('danger', 'Welcome to lms learning.');
        return redirect()->route('home');
    }
}
