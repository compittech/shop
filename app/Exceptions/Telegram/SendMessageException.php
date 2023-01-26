<?php

namespace App\Exceptions\Telegram;

use Exception;

class SendMessageException extends Exception
{
    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report() :bool|null
    {
        return false;
    }
}
