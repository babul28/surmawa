<?php

namespace App\Http\Livewire\Lecturer\Analytics;

use App\Models\Survey;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ActiveSurvey extends Component
{
    use WithSelectedMonthState;

    public function getActiveSurveyProperty(): int
    {
        return Survey::query()
            ->whereMonth('created_at', $this->month())
            ->whereDate('expired_at', '>=', Carbon::now())
            ->where('lecturer_id', Auth::id())
            ->count();
    }

    public function render()
    {
        return view('livewire.lecturer.analytics.active-survey');
    }
}
