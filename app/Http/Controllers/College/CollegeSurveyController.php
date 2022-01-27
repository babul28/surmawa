<?php

namespace App\Http\Controllers\College;

use App\Http\Controllers\Controller;

class CollegeSurveyController extends Controller
{
    public function __invoke()
    {
        return view('college.surveys.index');
    }
}
