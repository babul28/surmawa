<?php

namespace App\Actions;

use App\Models\SurveyRespondent;
use App\Models\Survey;
use App\Services\QuestionService;
use Illuminate\Support\Facades\Cookie;

class SubmitQuestionerAction
{
    protected QuestionService $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    public function handle()
    {
        $answers = json_decode(Cookie::get('surveys-answers'), true);
        $biodata = json_decode(Cookie::get('surveys-biodata'), true);
        $surveyCode = Cookie::get('survey_code');
        $survey = Survey::where('survey_code', $surveyCode)->firstOrFail();
        $respondentId = Cookie::get('respondent-identifier');

        $questionWithAnswers = $this->questionService->getQuestionsWithAnswers($answers);

        $payload = [
            'respondent_id' => $respondentId,
            'survey_id' => $survey->id,
            'name' => $biodata['name'],
            'nim' => $biodata['nim'],
            'gender' => $biodata['gender'],
            'answers' => $questionWithAnswers->toArray(),
            'summary' => [],
        ];

        $respondent = SurveyRespondent::create($payload);

        $this->deleteAllCookies();

        return $respondent;
    }

    protected function deleteAllCookies(): void
    {
        Cookie::queue(Cookie::forget('surveys-answers'));
        Cookie::queue(Cookie::forget('surveys-biodata'));
        Cookie::queue(Cookie::forget('survey_code'));
    }
}
