<?php

namespace App\Http\Livewire\Modals\Lecturer\Survey;

use App\Actions\CreateNewSurveyAction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class SurveyFormModal extends Component
{
    public array $state = [];

    public array $minDates = [];

    public function mount(): void
    {
        $this->setDefaultStartingDate();
        $this->setDefaultExpiredDate();
    }

    protected function setDefaultStartingDate(): void
    {
        $currentDateTime = Carbon::now()->setTimezone('Asia/Jakarta');
        $this->minDates['date_starting_at'] = $this->state['date_starting_at'] = $currentDateTime->toDateString();
        $this->minDates['time_starting_at'] = $this->state['time_starting_at'] = $currentDateTime->addHour()->format('H:i');

        $this->state['starting_at'] = $currentDateTime->format('Y-m-d H:i');
    }

    protected function setDefaultExpiredDate(): void
    {
        $expectExpiredDate = Carbon::now()->addHours(4)->setTimezone('Asia/Jakarta');

        $this->minDates['date_expired_at'] = $this->state['date_expired_at'] = $expectExpiredDate->toDateString();
        $this->minDates['time_expired_at'] = $this->state['time_expired_at'] = $expectExpiredDate->format('H:i');

        $this->state['expired_at'] = $expectExpiredDate->format('Y-m-d H:i');
    }

    public function updatedState($value, $property): void
    {
        if (Str::is('*_starting_at', $property)) {
            if ($property === 'date_starting_at') {
                $this->updateDateStartingAt($value, $property);
            }

            if ($property === 'time_starting_at') {
                $this->updateTimeStartingAt($value, $property);
            }

            $this->updateStartingAt();
            $this->updateExpiredAt();
        }

        if (Str::is('*_expired_at', $property)) {
            if ($property === 'date_expired_at') {
                $this->updateDateExpiredAt($value, $property);
            }

            if ($property === 'time_expired_at') {
                $this->updateTimeExpiredAt($value, $property);
            }

            $this->updateExpiredAt();
        }
    }

    /**
     * Handle updating state of date starting at
     *
     * @param $value
     * @param string $property
     * @return void
     *
     * @TODO
     * - check the new date is less than expected min starting date or not
     * - if yes, than update current value to min starting date
     * - after that, updating expected min expired datetime
     * - finally, check the current expired datetime state is less than expected expired date or not
     * - if yes, than update current expired datetime to equal with expected expired datetime
     *
     */
    protected function updateDateStartingAt($value, string $property): void
    {
        $minStartingDate = $this->minDates['date_starting_at'];

        if (Carbon::parse($value)->lessThan(Carbon::parse($minStartingDate))) {
            $this->state[$property] = $value = $minStartingDate;
        }

        $expectMinExpiredDate = Carbon::parse($value . ' ' . $this->state['time_starting_at'], 'Asia/Jakarta')->addHours(3);
        $this->updateMinExpiredDates($expectMinExpiredDate);

        $this->checkingStateExpiredDate($expectMinExpiredDate);
    }

    /**
     * Update expected min expired dates
     *
     * @param Carbon $expectMinExpiredDate
     * @return void
     */
    protected function updateMinExpiredDates(Carbon $expectMinExpiredDate): void
    {
        $this->minDates['date_expired_at'] = $expectMinExpiredDate->toDateString();
        $this->minDates['time_expired_at'] = $expectMinExpiredDate->format('H:i');
    }

    /**
     * Handle to checking the expired datetime state
     * must be greater than or equal with expected expired datetime
     *
     * @param Carbon $expectMinExpiredDate
     * @return void
     */
    protected function checkingStateExpiredDate(Carbon $expectMinExpiredDate): void
    {
        $stateExpiredDate = Carbon::parse($this->state['date_expired_at'] . ' ' . $this->state['time_expired_at'], 'Asia/Jakarta');

        if ($stateExpiredDate->lessThan($expectMinExpiredDate)) {
            $this->state['date_expired_at'] = $expectMinExpiredDate->toDateString();
            $this->state['time_expired_at'] = $expectMinExpiredDate->format('H:i');
        }
    }

    /**
     * Handle updating state of time starting at
     *
     * @param $value
     * @param string $property
     * @return void
     *
     * @TODO
     * - check the new time is less than expected min starting time or not
     * - if yes, than update current value to min starting time
     * - after that, updating expected min expired datetime
     * - finally, check the current expired datetime state is less than expected expired date or not
     * - if yes, than update current expired datetime to equal with expected expired datetime
     *
     */
    protected function updateTimeStartingAt($value, string $property): void
    {
        $minTimeStartingDate = sprintf('%s %s', $this->minDates['date_starting_at'], $this->minDates['time_starting_at']);
        $newStartingDate = sprintf('%s %s', $this->state['date_starting_at'], $value);

        if (Carbon::parse($newStartingDate)->lessThan(Carbon::parse($minTimeStartingDate))) {
            $this->state[$property] = $value = $minTimeStartingDate;
        }

        $expectMinExpiredDate = Carbon::parse($this->state['date_starting_at'] . ' ' . $value, 'Asia/Jakarta')->addHours(3);
        $this->updateMinExpiredDates($expectMinExpiredDate);

        $this->checkingStateExpiredDate($expectMinExpiredDate);
    }

    /**
     * Handle update starting at
     *
     * @return void
     */
    protected function updateStartingAt(): void
    {
        $this->state['starting_at'] = sprintf('%s %s', $this->state['date_starting_at'], $this->state['time_starting_at']);
    }

    /**
     * Update expired at
     *
     * @return void
     */
    protected function updateExpiredAt(): void
    {
        $this->state['expired_at'] = sprintf('%s %s', $this->state['date_expired_at'], $this->state['time_expired_at']);
    }

    /**
     * Handle updated date expired at state
     *
     * @param $value
     * @param string $property
     * @return void
     *
     * @TODO
     * - check the new value of date expired at must be greater or equal than expected min expired date
     * - if less than expected min expired date, than update to equal with min expired date
     */
    protected function updateDateExpiredAt($value, string $property): void
    {
        $minExpiredDate = $this->minDates['date_expired_at'];

        if (Carbon::parse($value)->lessThan(Carbon::parse($minExpiredDate))) {
            $this->state[$property] = $minExpiredDate;
        }
    }

    /**
     * Handle updated time expired at state
     *
     * @param $value
     * @param string $property
     * @return void
     *
     * @TODO
     * - check the new value of time expired at must be greater or equal than expected min expired time
     * - if less than expected min expired time, than update to equal with min expired time
     */
    protected function updateTimeExpiredAt($value, string $property): void
    {
        $minTimeExpiredDate = sprintf('%s %s', $this->minDates['date_expired_at'], $this->minDates['time_expired_at']);
        $newExpiredDate = sprintf('%s %s', $this->state['date_expired_at'], $value);

        if (Carbon::parse($newExpiredDate)->lessThan(Carbon::parse($minTimeExpiredDate))) {
            $this->state[$property] = $minTimeExpiredDate;
        }
    }

    /**
     * Handle submitting the form
     *
     * @param CreateNewSurveyAction $createNewSurveyAction
     * @return void
     */
    public function submit(CreateNewSurveyAction $createNewSurveyAction): void
    {
        $this->resetErrorBag();

        $lecturer = Auth::user();
        $createNewSurveyAction->handle($lecturer, $this->state);

        $this->emit('closeModal');
        $this->emit('refreshSurveyList');
    }

    public function render()
    {
        return view('livewire.modals.lecturer.survey.survey-form-modal');
    }
}
