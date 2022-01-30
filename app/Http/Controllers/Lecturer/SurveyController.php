<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;

class SurveyController extends Controller
{
    public function __invoke()
    {
        return view('lecturer.surveys.index');
    }
}
