<?php

namespace App\Http\Livewire\Lecturer\Analytics;

use App\Models\Survey;
use App\Models\SurveyRespondent;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chart extends Component
{
    public string $year = '';

    public function mount(): void
    {
        $this->year = Carbon::now()->year;
    }

    public function initChart(): void
    {
        $this->emit('initAnalyticsChart', $this->year, $this->dataset);
    }

    public function getDatasetProperty(): array
    {
        $default = $this->defaultData();

        $surveysCount = Survey::query()
            ->selectRaw('count(*) as total, DATE_FORMAT(created_at, "%b") as month')
            ->whereYear('created_at', (int)$this->year)
            ->where('lecturer_id', Auth::id())
            ->groupByRaw('DATE_FORMAT(created_at, "%b")')
            ->pluck('total', 'month')
            ->toArray();

        $subQuery = Survey::query()->where('lecturer_id', Auth::id());
        $submissionsCount = SurveyRespondent::query()
            ->selectRaw('count(*) as total, DATE_FORMAT(survey_respondents.created_at, "%b") as month')
            ->joinSub($subQuery, 'surveys', 'surveys.id', '=', 'survey_respondents.survey_id')
            ->whereYear('survey_respondents.created_at', $this->year)
            ->groupByRaw('DATE_FORMAT(survey_respondents.created_at, "%b")')
            ->pluck('total', 'month')
            ->toArray();

        $data = collect([
            'Active Survey' => array_merge($default, $surveysCount),
            'Total Submission' => array_merge($default, $submissionsCount),
            'Total Report' => $default,
        ]);

        return $data->map(fn($item, $key) => ['label' => $key, 'data' => array_values($item)])->values()->toArray();
    }

    protected function defaultData(): array
    {
        return ['Jan' => 0, 'Feb' => 0, 'Mar' => 0, 'Apr' => 0, 'May' => 0, 'Jun' => 0, 'Jul' => 0, 'Aug' => 0, 'Sep' => 0, 'Oct' => 0, 'Nov' => 0, 'Dec' => 0];
    }

    public function updatedYear($value): void
    {
        $this->emit('updateAnalyticsChart', $value, $this->dataset);
    }

    public function render()
    {
        return view('livewire.lecturer.analytics.chart');
    }
}
