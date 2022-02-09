<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;

class SurveyExpiredAtRule implements Rule, DataAwareRule
{
    protected array $data;

    protected string $expectedExpiredAt;

    protected string $attributeName;

    /**
     * @param string $attributeName
     */
    public function __construct(string $attributeName = 'expires on')
    {
        $this->attributeName = $attributeName;
    }

    public function passes($attribute, $value): bool
    {
        $startingDatetime = Carbon::parse($this->data['starting_at'], 'Asia/Jakarta');
        $expiredDatetime = Carbon::parse($value, 'Asia/Jakarta');

        $this->setExpectedExpiredAt(clone $startingDatetime);

        return ($expiredDatetime->diffInHours($startingDatetime) >= 3);
    }

    protected function setExpectedExpiredAt(Carbon $startingDatetime): void
    {
        $this->expectedExpiredAt = $startingDatetime->addHours(3)->format('Y-m-d H:i');
    }

    public function message(): string
    {
        return __('validation.min.numeric', ['attribute' => $this->attributeName, 'min' => $this->expectedExpiredAt]);
    }

    public function setData($data)
    {
        $this->data = $data;
    }
}
