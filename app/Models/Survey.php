<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    public const ACTIVE = 1;
    public const DEACTIVE = 0;

    protected $guarded = [];
}
