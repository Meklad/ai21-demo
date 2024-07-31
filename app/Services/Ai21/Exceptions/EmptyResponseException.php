<?php

namespace App\Services\Ai21\Exceptions;

use Exception;

/**
 * This Exception Handle ai21 Empty Response.
 */
class EmptyResponseException extends Exception
{
    /**
     * Exception Status Code.
     *
     * @var integer
     */
    public $code = 510;

    /**
     * Exception Message.
     *
     * @var string
     */
    public $message = "Error While Generate Response From ai21";
}
