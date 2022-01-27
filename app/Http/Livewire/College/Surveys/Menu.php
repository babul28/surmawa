<?php

namespace App\Http\Livewire\College\Surveys;

use Illuminate\Http\Request;
use Livewire\Component;

class Menu extends Component
{
    public string $step = 'biodata';

    protected $listeners = [
        'updateStep' => 'handlingUpdateStepComponent',
    ];

    public function mount(Request $request): void
    {
        $this->fill($request->only('step'));
    }

    public function handlingUpdateStepComponent(string $step): void
    {
        $this->step = $step;
    }

    public function render()
    {
        return view('livewire.college.surveys.menu');
    }
}
