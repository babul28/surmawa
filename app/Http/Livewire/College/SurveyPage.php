<?php

namespace App\Http\Livewire\College;

use Illuminate\Http\Request;
use Livewire\Component;

class SurveyPage extends Component
{
    public string $step = "biodata";

    public array $data = [];

    protected $queryString = [
        'step' => ['except' => ''],
    ];

    protected $listeners = [
        'updateStep' => 'handlingUpdateStepComponent',
    ];

    public function mount(Request $request): void
    {
        if ($request->hasCookie('surveys-biodata')) {
            $this->data['biodata'] = json_decode($request->cookie('surveys-biodata'), true, 512, JSON_THROW_ON_ERROR);
        }

        if ($request->hasCookie('surveys-answers')) {
            $this->data['questionnaire']['answers'] = json_decode($request->cookie('surveys-answers'), true, 512, JSON_THROW_ON_ERROR);
        }
    }

    public function handlingUpdateStepComponent(string $step): void
    {
        $this->step = $step;
    }

    public function getComponentFullPathProperty(): string
    {
        return "college.surveys.steps.{$this->step}";
    }

    public function render()
    {
        return view('livewire.college.survey-page');
    }
}
