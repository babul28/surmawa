<?php

namespace App\Http\Livewire\Lecturer\Analytics;

use Illuminate\Support\Carbon;
use Livewire\Component;

class Overview extends Component
{
    public string $month = '';

    public function mount(): void
    {
        $this->month = Carbon::now()->monthName;
    }

    public function updatingMonth($value): void
    {
        if ($this->month !== $value) {
            $this->emit('updateSelectedMonth', $value);
        }
    }

    public function render()
    {
        return view('livewire.lecturer.analytics.overview');
    }
}
