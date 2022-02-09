<?php

namespace App\Actions;

use App\Models\Lecturer;
use App\Models\Survey;
use App\Rules\SurveyExpiredAtRule;
use App\Rules\SurveyStartingAtRule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CreateNewSurveyAction
{
    public function handle(Lecturer $lecturer, array $payload): Survey
    {
        $validatedData = Validator::make($payload, $this->rules())->validateWithBag('validating-create-new-survey-request');

        $payload = [
            'name' => $validatedData['name'],
            'department_name' => $validatedData['department'],
            'faculty_name' => $validatedData['faculty'],
            'university_name' => $validatedData['university'],
            'survey_code' => Str::random(6),
            'starting_at' => $this->parseToUTCTimezone($validatedData['starting_at']),
            'expired_at' => $this->parseToUTCTimezone($validatedData['expired_at']),
        ];

        return $lecturer->surveys()->create($payload);
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:200'],
            'department' => ['required', 'string', 'max:200'],
            'faculty' => ['required', 'string', 'max:200'],
            'university' => ['required', 'string', 'max:200'],
            'starting_at' => ['required_with:expired_at', 'date', new SurveyStartingAtRule()],
            'expired_at' => ['required_with:starting_at', 'date', new SurveyExpiredAtRule()],
        ];
    }

    protected function parseToUTCTimezone(string $date): Carbon
    {
        return Carbon::parse($date, 'Asia/Jakarta')->setTimezone('UTC');
    }
}
