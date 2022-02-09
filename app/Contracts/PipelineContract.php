<?php

namespace App\Contracts;

use Closure;

interface PipelineContract
{
    public function handle($context, Closure $next);
}
