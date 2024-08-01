<?php

namespace App\Services\Chat\Exceptions;

use Exception;

/**
 * This Exception Handle empty chat log AKA prompt.
 */
class EmptyPromptException extends Exception
{
    /**
     * Exception Status Code.
     *
     * @var integer
     */
    public $code = 520;

    /**
     * Exception Message.
     *
     * @var string
     */
    public $message = "Cannot Craete New Chat Without Prompt";
}
