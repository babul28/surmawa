<?php

namespace App\Services;

use App\Models\Question;
use Illuminate\Database\Eloquent\Collection;

class QuestionService
{
    public function getQuestionsWithAnswers(?array $answers): \Illuminate\Support\Collection
    {
        $questions = $this->getQuestions();

        return $questions->map(function (Question $question, $idx) use ($answers) {
            return [
                'question' => $question->question,
                'answer' => $answers[$idx],
            ];
        });
    }

    public function getQuestions(): Collection
    {
        return Question::query()->get();
    }
}
