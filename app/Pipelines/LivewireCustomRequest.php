<?php

namespace App\Pipelines;

use Illuminate\Http\Request;

abstract class LivewireCustomRequest
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
