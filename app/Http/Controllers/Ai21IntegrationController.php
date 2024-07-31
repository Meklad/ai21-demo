<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Services\Ai21\Ai21Service;
use Illuminate\Contracts\View\View;
use App\Http\Requests\CreatePromptRequest;

/**
 * This controller contains all users actions that deal with ai21 integration.
 */
class Ai21IntegrationController extends Controller
{
    /**
     * OpenAiIntegrationController Constructor.
     *
     * @param OpenAIService $openAIService
     */
    public function __construct(private Ai21Service $openAIService){}

    /**
     * Return prompt view to main dashboard view.
     *
     * @return View
     */
    public function index(): View
    {
        return view("dashboard")->with([
            "aiResponse" => null
        ]);
    }

    /**
     * Call the v1 ai21 to get the chat-gpt response.
     *
     * @param CreatePromptRequest $request
     * @return JsonResponse
     */
    public function getAiResponse(CreatePromptRequest $request): JsonResponse
    {
        return response()->json([
            "success" => true,
            "status" => Response::HTTP_OK,
            "ai_response" => $this->openAIService->generateResponse($request->prompt)
        ], Response::HTTP_OK);
    }
}
