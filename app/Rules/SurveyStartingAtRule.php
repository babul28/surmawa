<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class SurveyStartingAtRule implements Rule
{
    protected string $expectedStartingAt;

    protected string $attributeName;

    /**
     * @param string $attributeName
     */
    public function __construct(string $attributeName = 'starts on')
    {
        $this->attributeName = $attributeName;
    }

    public function passes($attribute, $value): bool
    {
        $currentDateTime = Carbon::now()->setTimezone('Asia/Jakarta');
        $validateDate = Carbon::parse($value, 'Asia/Jakarta');

        $this->setExpectedStartingAt(clone $currentDateTime);

        return ($validateDate->diffInMinutes($currentDateTime) >= 50);
    }

    protected function setExpectedStartingAt(Carbon $currentDateTime): void
    {
        $this->expectedStartingAt = $currentDateTime->addHour()->format('Y-m-d H:i');
    }

    public function message(): string
    {
        return __('validation.min.numeric', ['attribute' => $this->attributeName, 'min' => $this->expectedStartingAt]);
    }
}
