<?php

namespace App\Http\Livewire\Lecturer\Analytics;

trait WithSelectedMonthState
{
    public string $selectedMonth = '';

    public function initializeWithSelectedMonthState(): void
    {
        $this->listeners = array_merge($this->listeners, ['updateSelectedMonth']);
    }

    public function updateSelectedMonth($value): void
    {
        $this->selectedMonth = $value;
    }

    public function month(): int
    {
        return [
            'January' => 1,
            'February' => 2,
            'March' => 3,
            'April' => 4,
            'May' => 5,
            'June' => 6,
            'July' => 7,
            'August' => 8,
            'September' => 9,
            'October' => 10,
            'November' => 11,
            'December' => 12,
        ][$this->selectedMonth];
    }
}
