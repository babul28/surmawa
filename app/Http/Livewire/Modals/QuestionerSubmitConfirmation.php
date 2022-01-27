<?php

namespace App\Http\Livewire\Modals;

use App\Actions\SubmitQuestionerAction;
use Livewire\Component;

class QuestionerSubmitConfirmation extends Component
{
    public function confirm(SubmitQuestionerAction $submitQuestionerAction): void
    {
        $respondent = $submitQuestionerAction->handle();

        $this->emit('closeModal');
        $this->redirectRoute('college.survey.summary', $respondent->id);
    }

    public function render()
    {
        return view('livewire.modals.questioner-submit-confirmation');
    }
}
