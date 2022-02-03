<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Survey extends Model
{
    public const ACTIVE = 1;
    public const DEACTIVE = 0;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    protected $casts = [
        'expired_at' => 'immutable_datetime',
    ];

    protected static function booted(): void
    {
        static::creating(fn(self $model) => $model->id = Uuid::uuid4());
    }

    public function getStatusDescAttribute(): string
    {
        if ($this->status === self::DEACTIVE) {
            return 'inactive';
        }

        if (!$this->expired_at->isFuture()) {
            return 'expired';
        }

        return 'active';
    }

    public function scopeFuzzySearch(Builder $query, string $searchString, array $fields): Builder
    {
        if (!$searchString) {
            return $query;
        }

        $words = explode(' ', $searchString);

        return $query->where(function (Builder $q) use ($words, $fields) {
            foreach ($fields as $field) {
                $q->orWhere(function (Builder $b) use ($field, $words) {
                    foreach ($words as $word) {
                        $b->where($field, 'LIKE', "%$word%");
                    }
                });
            }
        });
    }
}
