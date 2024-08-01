<?php

/**
 * Ai21 Base Service.
 *
 * @php      8.3
 * @category Ai_Inttegration
 * @package  Ai21Integration
 * @author   Owllog <ahmed.meklad.news@gmail.com>
 * @license  GNU-GPL <https://www.gnu.org/licenses/gpl-3.0.html>
 * @link     Meklad <https://github.com/meklad>
 */

namespace App\Services\Ai21;

use App\Services\Ai21\Contracts\Ai21ServiceContract;
use App\Services\Ai21\Exceptions\EmptyResponseException;
use Illuminate\Support\Facades\Http;

class Ai21Service implements Ai21ServiceContract
{
    /**
     * This method call ai21 v1 api by sending prompt and endpoint that will
     * append to the base url and return the generated reponse by ai21-j2-mid.
     *
     * @param mixed $prompt      <String by user represents a question promopt>
     * @param string $model_type <Ai Model Type>
     *
     * @return string
     */
    public function generateResponse(mixed $prompt, string $model_type = "j2-mid"): string
    {
        dd($prompt);
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

        throw new EmptyResponseException();
    }
}
