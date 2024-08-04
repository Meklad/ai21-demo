<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Services\Chat\ChatService;
use Illuminate\Contracts\View\View;
use App\Http\Requests\CreatePromptRequest;
use App\Models\Chat;

/**
 * This controller contains all users actions that deal with ai21 integration.
 */
class Ai21IntegrationController extends Controller
{
    /**
     * OpenAiIntegrationController Constructor.
     *
     * @param ChatService $chatService
     */
    public function __construct(private ChatService $chatService){}

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
        $chat = null;

        if(isset($request->chat_id)) {
            $chat = Chat::find($request->chat_id);
        }

        $ai_response = $this->chatService->createOrUpdate(
            prompt: $request->prompt,
            user: auth()->user(),
            title: $chat != null ? $chat->title : "New Chat",
            ai_service: "ai21",
            model_type: "j2-ultra",
            chat: $chat
        );

        return response()->json([
            "success" => true,
            "status" => Response::HTTP_OK,
            "ai_response" => $ai_response
        ], Response::HTTP_OK);
    }
}
