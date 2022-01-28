<?php

namespace App\Http\Livewire\Lecturer\Analytics;

use App\Models\Survey;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TotalSurvey extends Component
{
    use WithSelectedMonthState;

    public function getTotalSurveyProperty(): int
    {
        return Survey::query()
            ->whereMonth('created_at', $this->month())
            ->where('lecturer_id', Auth::id())
            ->count();
    }

    public function render()
    {
        return view('livewire.lecturer.analytics.total-survey');
    }
}
