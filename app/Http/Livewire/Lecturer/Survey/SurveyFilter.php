<?php

namespace App\Http\Livewire\Lecturer\Survey;

use Illuminate\Http\Request;
use Livewire\Component;

class SurveyFilter extends Component
{
    public string $filter = '';
    public string $search = '';
    public string $sort = 'latest';

    protected $listeners = [
        'openCreateSurveyModalForm' => 'openModalForm',
    ];

    public function mount(Request $request): void
    {
        $this->fill($request->only(['filter', 'search', 'sort']));
    }

    public function updating(string $property, string $value): void
    {
        if ($this->{$property} !== $value) {
            $this->emit('updatingFilter', [$property => $value]);
        }
    }

    public function resetState(): void
    {
        $this->reset();

        $this->emit('updatingFilter', [
            'filter' => '',
            'sort' => 'latest'
        ]);
    }

    public function openModalForm(): void
    {
        $this->emit(
            'openModal',
            'lecturer.survey.survey-form-modal',
            [],
            [
                'maxWidth' => 'xl'
            ]
        );
    }

    public function render()
    {
        return view('livewire.lecturer.survey.survey-filter');
    }
}
