<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Uuid;

class Lecturer extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    public $incrementing = false;

    protected $guarded = [];

    protected $keyType = 'string';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(fn(self $model) => $model->id = Uuid::uuid4());
    }

    public function surveys(): HasMany
    {
        return $this->hasMany(Survey::class);
    }
}
