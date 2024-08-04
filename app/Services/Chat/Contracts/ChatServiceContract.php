<?php

namespace App\Services\Chat\Contracts;

use App\Models\Chat;
use App\Models\User;

/**
 * This is the rules of chat Service, And must add generic methods in this contract.
 */
interface ChatServiceContract
{
    /**
     * This method create or update chat to the database.
     *
     * @param array $prompt
     * @param User $user
     * @param string|null $title
     * @param string $ai_service
     * @param string $model_type
     * @param Chat|null $chat
     * @return array
     */
    public function createOrUpdate(array $prompt, User $user, string $title, string $ai_service = "ai21", string $model_type = "j2-mid", Chat|null $chat = null): array;
}
