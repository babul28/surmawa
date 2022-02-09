<?php

namespace App\Traits\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

trait WithStatusScope
{
    public function scopeHasStarted(Builder $builder, bool $isStarted = true): Builder
    {
        return $builder->where('starting_at', !$isStarted ? '>' : '<=', Carbon::now());
    }

    public function scopeHasExpired(Builder $builder, bool $isExpired = true): Builder
    {
        return $builder->hasStarted()->where('expired_at', !$isExpired ? '>' : '<=', Carbon::now());
    }

    public function scopeHasActive(Builder $builder, bool $isActive = true): Builder
    {
        if (!$isActive) {
            return $builder->hasStarted(false);
        }

        return $builder->hasExpired(false);
    }

    public function scopeHasInactive(Builder $builder): Builder
    {
        return $builder->hasActive(false);
    }

    public function getStatusDescAttribute(): string
    {
        if ($this->isActive()) {
            return 'active';
        }

        if ($this->isExpired()) {
            return 'expired';
        }

        return 'inactive';
    }

    public function isActive(): bool
    {
        return $this->isStarted() && !$this->isExpired();
    }

    public function isStarted(): bool
    {
        return $this->starting_at->lessThanOrEqualTo(Carbon::now());
    }

    public function isExpired(): bool
    {
        return $this->isStarted() && $this->expired_at->lessThanOrEqualTo(Carbon::now());
    }

    public function isInactive(): bool
    {
        return !$this->isStarted();
    }
}
