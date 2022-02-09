<?php

namespace App\Models;

use App\Traits\Model\WithStatusScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Survey extends Model
{
    use WithStatusScope;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    protected $casts = [
        'starting_at' => 'immutable_datetime',
        'expired_at' => 'immutable_datetime',
    ];

    protected static function booted(): void
    {
        static::creating(fn(self $model) => $model->id = Uuid::uuid4());
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
