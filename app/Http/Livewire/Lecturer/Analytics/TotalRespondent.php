<?php

namespace App\Http\Livewire\Lecturer\Analytics;

use App\Models\Survey;
use App\Models\SurveyRespondent;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TotalRespondent extends Component
{
    use WithSelectedMonthState;

    public function getTotalRespondentProperty(): int
    {
        $subQuery = Survey::query()
            ->where('lecturer_id', Auth::id());

        return SurveyRespondent::query()
            ->joinSub($subQuery, 'surveys', 'surveys.id', '=', 'survey_respondents.survey_id')
            ->whereMonth('survey_respondents.created_at', $this->month())
            ->count();
    }

    public function render()
    {
        return view('livewire.lecturer.analytics.total-respondent');
    }
}
