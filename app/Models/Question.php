<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Question extends Model
{
    public $incrementing = false;

    protected $guarded = [];

    protected $keyType = 'string';

    protected static function booted(): void
    {
        static::creating(fn(self $model) => $model->id = Uuid::uuid4());
    }
}
