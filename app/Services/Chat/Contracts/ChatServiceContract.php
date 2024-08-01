<?php

namespace App\Services\Chat\Contracts;

use App\Models\User;

/**
 * This is the rules of chat Service, And must add generic methods in this contract.
 */
interface ChatServiceContract
{
    /**
     * This method store new chat to the database.
     *
     * @param array $prompt
     * @param User $user
     * @param string $title
     * @param string $ai_service
     * @param string $model_type
     * @return array
     */
    public function store(array $prompt, User $user, string $title, string $ai_service = "ai21", string $model_type = "j2-mid"): array;
}
