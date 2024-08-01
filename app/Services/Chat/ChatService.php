<?php

/**
 * Chat Base Service.
 *
 * @php      8.3
 * @category Chat_Service
 * @package  ChatService
 * @author   Owllog <ahmed.meklad.news@gmail.com>
 * @license  GNU-GPL <https://www.gnu.org/licenses/gpl-3.0.html>
 * @link     Meklad <https://github.com/Meklad/ai21-demo>
 */

namespace App\Services\Chat;

use App\Models\Chat;
use App\Models\User;
use App\Models\ChatLog;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Chat\Contracts\ChatServiceContract;
use App\Services\Chat\Exceptions\EmptyPromptException;

class ChatService implements ChatServiceContract
{
    /**
     * This method store new chat and chat logs to the database.
     *
     * @param array $prompt
     * @param User $user
     * @param string $title
     * @param string $ai_service
     * @param string $model_type
     * @return array
     */
    public function store(array $prompt, User $user, string $title, string $ai_service = "ai21", string $model_type = "j2-mid"): array
    {
        $chat = $this->createChat($title, $ai_service, $model_type, $user);
        $dbPrompt = $this->createChatLog($chat, $prompt, $user);
        $messages = $this->mapPromp($dbPrompt);

        return [];
    }

    /**
     * This method store new chat to the database.
     *
     * @param string $title
     * @param string $ai_service
     * @param string $model_type
     * @param User $user
     * @return Chat
     */
    public function createChat(string $title, string $ai_service, string $model_type, User $user): Chat
    {
        return Chat::create([
            'title' => $title,
            'ai_service' => $ai_service,
            'model_type' => $model_type,
            'user_id' => $user->id
        ]);
    }

    /**
     * This method store new chat log aka promopt to the database.
     *
     * @param Chat $chat
     * @param array $prompt
     * @param User $user
     * @return Collection
     */
    public function createChatLog(Chat $chat, array $prompt, User $user): Collection
    {
        if(count($prompt) > 0) {
            foreach($prompt as $messagePrompt) {
                $chat->logs()->create([
                    'text' => $messagePrompt["text"],
                    'role' => $messagePrompt["role"],
                    'chat_id' => $chat->id,
                    'user_id' => $user->id
                ]);
            }

            return $chat->logs;
        }

        throw new EmptyPromptException;
    }

    /**
     * Map prompts before ai api call.
     *
     * @param Collection $prompts
     * @return array
     */
    public function mapPromp(Collection $prompts): array
    {
        return $prompts->map(function ($prompt) {
            return [
                'text' => $prompt->text,
                'role' => $prompt->role,
            ];
        })->toArray();
    }
}
