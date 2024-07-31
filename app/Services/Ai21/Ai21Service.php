<?php

namespace App\Services\Ai21;

use App\Services\Ai21\Contracts\Ai21ServiceContract;
use App\Services\Ai21\Exceptions\EmptyResponseException;
use Illuminate\Support\Facades\Http;

/**
 * ai21 Base Service.
 */
class Ai21Service implements Ai21ServiceContract
{
    /**
     * This method call ai21 v1 api by sending prompt and endpoint that will
     * append to the base url and return the generated reponse by ai21-j2-mid.
     *
     * @param string $prompt
     * @param string $model_type
     * @return string
     */
    public function generateResponse(string $prompt, string $model_type = "j2-mid"): string
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config("ai21.api-key"),
            'Content-Type' => 'application/json',
        ])->post(config("ai21.v1-url") . $model_type . "/complete", [
            'prompt' => $prompt,
            'numResults' => 1,
            'maxTokens' => 800,
            'temperature' => 0.7,
            'topP' => 1,
            'stopSequences' => []
        ]);

        $body = $response->json();

        if(isset($body["completions"][0]["data"]["text"])) {
            return $body["completions"][0]["data"]["text"];
        }

        throw new EmptyResponseException;
    }
}
