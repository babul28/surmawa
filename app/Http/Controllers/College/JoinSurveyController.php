<?php

namespace App\Http\Controllers\College;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class JoinSurveyController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        Validator::make($request->all(), $this->rules())->validate();

        $survey_code = $request->get('survey_code');
        $cookie = cookie('survey_code', $survey_code, 60 * 60);

        return redirect()
            ->route('college.survey.biodata')
            ->cookie($cookie);
    }

    protected function rules(): array
    {
        return [
            'survey_code' => [
                'required',
                'string',
                'size:6',
                Rule::exists('surveys', 'survey_code'),
            ],
        ];
    }
}
