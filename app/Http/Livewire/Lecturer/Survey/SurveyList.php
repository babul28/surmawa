<?php

namespace App\Http\Livewire\Lecturer\Survey;

use App\Models\Survey;
use App\Pipelines\CustomSort;
use App\Pipelines\FilterByStatus;
use App\Pipelines\FuzzySearch;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;

class SurveyList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filter = '';
    public string $sort = 'latest';

    protected $listeners = [
        'updatingFilter',
        'refreshSurveyList' => '$refresh',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'filter' => ['except' => ''],
        'sort' => ['except' => ''],
    ];

    public function updatingFilter(array $data): void
    {
        foreach ($data as $property => $value) {
            $this->{$property} = $value;
        }

        $this->resetPage();
    }

    public function getSurveysProperty(): LengthAwarePaginator
    {
        // bind state to request object
        App::bind(Request::class, fn($app) => new Request($this->payload()));

        return app(Pipeline::class)
            ->send(Survey::query())
            ->through([
                FuzzySearch::class,
                FilterByStatus::class,
                CustomSort::class
            ])
            ->thenReturn()
            ->paginate(18);
    }

    protected function payload(): array
    {
        return [
            'sort' => $this->sort,
            'filter' => $this->filter,
            'search' => $this->search,
        ];
    }

    public function render()
    {
        return view('livewire.lecturer.survey.survey-list');
    }
}
