<?php

namespace App\Http\Livewire\College\Surveys\Steps;

use App\Services\QuestionService;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class Questionnaire extends Component
{
    public array $questions = [];
    public array $answers = [];
    public int $currentQuestion = 0;

    public function mount(QuestionService $questionService): void
    {
        if (empty($this->questions)) {
            $this->questions = $questionService->getQuestions()->toArray();
        }

        if (empty($this->answers)) {
            $this->answers = array_fill(0, count($this->questions), 0);
            $this->setAnswerCookie();
        }
    }

    protected function setAnswerCookie(): void
    {
        Cookie::queue('surveys-answers', json_encode($this->answers), 60 * 60);
    }

    public function updatedAnswers(): void
    {
        $this->setAnswerCookie();
    }

    public function getAlreadyAnsweredProperty(): array
    {
        return array_filter($this->answers);
    }

    public function getProgressInPercentProperty(): int
    {
        $answersCount = count($this->alreadyAnswered);
        $questionsCount = count($this->questions);

        return (int)($answersCount / $questionsCount * 100) ?? 0;
    }

    public function next(): void
    {
        if ($this->currentQuestion < count($this->questions) - 1) {
            ++$this->currentQuestion;
        }
    }

    public function previous(): void
    {
        if ($this->currentQuestion > 0) {
            --$this->currentQuestion;
        }
    }

    public function submit(): void
    {
        $this->emit('openModal', 'questioner-submit-confirmation');
    }

    public function render()
    {
        return view('livewire.college.surveys.steps.questionnaire');
    }
}
