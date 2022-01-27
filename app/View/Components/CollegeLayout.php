<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CollegeLayout extends Component
{
    public $title;

    public function __construct($title = null)
    {
        $this->title = $title;
    }

    public function render()
    {
        return view('layouts.college');
    }
}
