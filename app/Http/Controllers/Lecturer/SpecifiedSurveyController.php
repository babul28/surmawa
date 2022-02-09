<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Survey;

class SpecifiedSurveyController extends Controller
{
    public function __invoke(Survey $survey)
    {
        return $survey;
    }
}
