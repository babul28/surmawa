<?php

namespace App\Pipelines;

use App\Contracts\PipelineContract;
use Closure;

class FuzzySearch extends LivewireCustomRequest implements PipelineContract
{
    public function handle($context, Closure $next)
    {
        $response = $next($context);

        return $response->fuzzySearch($this->request->query('search', ''), ['name']);
    }
}
