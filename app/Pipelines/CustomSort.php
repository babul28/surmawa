<?php

namespace App\Pipelines;

use App\Contracts\PipelineContract;
use Closure;

class CustomSort extends LivewireCustomRequest implements PipelineContract
{
    public function handle($context, Closure $next)
    {
        $response = $next($context);

        return $this->request->query('sort') === 'oldest'
            ? $response->orderBy('created_at')
            : $response->orderByDesc('created_at');
    }
}
