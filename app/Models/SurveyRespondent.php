<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class SurveyRespondent extends Model
{
    protected $guarded = [];

    public $incrementing = false;

    protected $keyType = 'string';

    protected static function booted(): void
    {
        static::creating(fn(self $model) => $model->attributes['id'] = Uuid::uuid4());
    }

    protected $casts = [
        'answers' => 'array',
        'summary' => 'array'
    ];
}
