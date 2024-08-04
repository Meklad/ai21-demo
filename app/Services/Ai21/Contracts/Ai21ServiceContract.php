<?php

namespace App\Services\Ai21\Contracts;

/**
 * This is the rules of ai21 Service, And must add generic methods in this contract.
 */
interface Ai21ServiceContract
{
    /**
     * This method call ai21 v1 api by sending prompt and endpoint that will
     * append to the base url and return the generated reponse by ai21-j2-mid.
     *
     * @param array $prompt
     * @param string $model_type
     * @return array
     */
    public function generateResponse(array $prompt, string $model_type = "j2-mid"): array;
}
