<?php

namespace App\Http\Livewire\Lecturer;

use App\Models\Survey;
use App\Models\SurveyRespondent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LatestSubmission extends Component
{
    public function getLatestSubmissionProperty(): Collection
    {
        $subQuery = Survey::query()->where('lecturer_id', Auth::id());

        return SurveyRespondent::query()
            ->select(['survey_respondents.id', 'survey_respondents.name', 'survey_respondents.created_at'])
            ->joinSub($subQuery, 'surveys', 'surveys.id', '=', 'survey_respondents.survey_id')
            ->orderByDesc('survey_respondents.created_at')
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.lecturer.latest-submission');
    }
}
