<?php

namespace App\Http\Livewire\Lecturer\Survey;

use App\Models\Survey;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class SurveyList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filter = '';
    public string $sort = 'latest';

    protected $listeners = [
        'updatingFilter'
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'filter' => ['except' => ''],
        'sort' => ['except' => ''],
    ];

    public function updatingFilter(string $property, ?string $value): void
    {
        $this->{$property} = $value;
    }

    public function getSurveysProperty(): LengthAwarePaginator
    {
        return Survey::query()
            ->where('lecturer_id', Auth::id())
            ->fuzzySearch($this->search, ['name'])
            ->when($this->filter, function (Builder $q) {
                if ($this->filter === 'expired') {
                    return $q->where('expired_at', '<=', Carbon::now()->format('Y-m-d H:i'));
                }

                if ($this->filter === 'inactive') {
                    return $q->where('status', Survey::DEACTIVE);
                }

                return $q->where('expired_at', '>=', Carbon::now()->format('Y-m-d H:i'))
                    ->where('status', Survey::ACTIVE);
            })
            ->when($this->sort, function (Builder $q) {
                if ($this->sort === 'oldest') {
                    return $q->orderBy('created_at');
                }

                return $q->orderByDesc('created_at');
            })
            ->paginate(18);
    }

    public function render()
    {
        return view('livewire.lecturer.survey.survey-list');
    }
}
