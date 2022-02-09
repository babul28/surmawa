<?php

namespace App\Pipelines;

use App\Contracts\PipelineContract;
use Closure;

class FilterByStatus extends LivewireCustomRequest implements PipelineContract
{
    public function handle($context, Closure $next)
    {
        $filter = $this->request->query('filter');

        $response = $next($context);

        if (!$filter) {
            return $response;
        }

        if ($filter === 'expired') {
            return $response->hasExpired();
        }

        if ($filter === 'active') {
            return $response->hasActive();
        }

        return $response->hasActive(false);
    }
}
