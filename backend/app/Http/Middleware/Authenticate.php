<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }

    /**
     * Handle an unauthenticated user.
     *
     * @param Request $request
     * @param array<string> $guards
     * @return JsonResponse
     */
    protected function unauthenticated($request, array $guards): JsonResponse
    {
        abort(response()->json(['message' => 'Unauthorized',], Response::HTTP_UNAUTHORIZED));
    }
}
