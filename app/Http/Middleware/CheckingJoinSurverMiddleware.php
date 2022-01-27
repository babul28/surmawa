<?php

namespace App\Http\Middleware;

use App\Models\Survey;
use Closure;
use Illuminate\Http\Request;

class CheckingJoinSurverMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasCookie('survey_code')) {
            $surveyCode = $request->cookie('survey_code');

            if (Survey::where('survey_code', $surveyCode)->first()) {
                return $next($request);
            }
        }

        return redirect()->route('college.home');
    }
}
