<?php

namespace App\Http\Controllers\College;

use App\Http\Controllers\Controller;
use App\Models\SurveyRespondent;
use Illuminate\Http\Request;

class CollegeSurveySummaryController extends Controller
{
    public function __invoke(Request $request, SurveyRespondent $respondent)
    {
        // checking if guest user is authorized or not
        if ($respondent->respondent_id !== $request->cookie('respondent-identifier')){
            abort(403);
        }

        return view('college.survey-summary');
    }
}
