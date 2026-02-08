<?php

namespace App\Http\Controllers;

use App\Application\Services\QuizService;
use App\Http\Requests\Quiz\CreateQuizRequest;
use App\Http\Requests\Quiz\AddQuestionRequest;
use App\Http\Requests\Quiz\SubmitQuizRequest;
use App\Utils\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function __construct(private QuizService $service) {}

    // -------- QUIZ --------

    public function store(CreateQuizRequest $request): JsonResponse
    {
        $quiz = $this->service->createQuiz($request->validated());

        return ApiResponse::success($quiz, 'Quiz created successfully', 201);
    }

    // -------- QUESTIONS --------

    public function addQuestion(AddQuestionRequest $request): JsonResponse
    {
        $question = $this->service->addQuestion($request->validated());

        return ApiResponse::success($question, 'Question added successfully', 201);
    }

    // -------- ATTEMPTS --------

    public function startAttempt(Request $request, int $quizId): JsonResponse
    {
        $attempt = $this->service->startAttempt(
            $quizId,
            $request->user()->id
        );

        return ApiResponse::success($attempt, 'Quiz attempt started');
    }

    public function submit(SubmitQuizRequest $request, int $quizId): JsonResponse
    {
        $attempt = $this->service->submitAnswers(
            quizId: $quizId,
            userId: $request->user()->id,
            answers: $request->validated()['answers']
        );

        return ApiResponse::success(
            $attempt,
            'Quiz submitted successfully'
        );
    }

    public function attempts(int $quizId, Request $request): JsonResponse
    {
        $attempts = $this->service->getAttempts(
            $quizId,
            $request->user()->id
        );

        return ApiResponse::success(
            $attempts,
            'Quiz attempts retrieved successfully'
        );
    }
}
