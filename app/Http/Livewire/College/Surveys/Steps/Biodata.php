<?php

namespace App\Http\Livewire\College\Surveys\Steps;

use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class Biodata extends Component
{
    public string $name = '';
    public string $nim = '';
    public string $gender = '';

    public array $rules = [
        'name' => ['required', 'string', 'max:200'],
        'nim' => ['required', 'numeric'],
        'gender' => ['required']
    ];

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
        $this->setCookie();
    }

    protected function setCookie(): void
    {
        Cookie::queue('surveys-biodata', json_encode($this->statePayload()), 60 * 60);
    }

    protected function statePayload(): array
    {
        return [
            'name' => $this->name,
            'nim' => $this->nim,
            'gender' => $this->gender,
        ];
    }

    public function submitBiodata(): void
    {
        $this->validate();
        $this->setCookie();
        $this->emit('updateStep', 'questionnaire');
    }

    public function render()
    {
        return view('livewire.college.surveys.steps.biodata');
    }
}
