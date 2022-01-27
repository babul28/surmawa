<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class RespondentQuestionnaireIdentifierMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasCookie('respondent-identifier')) {
            return $next($request);
        }

        $uuid = Uuid::uuid4();
        $cookie = cookie()->forever('respondent-identifier', $uuid);
        $response = $next($request);
        return $response->withCookie($cookie);
    }
}
