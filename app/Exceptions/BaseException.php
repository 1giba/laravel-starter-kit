<?php

namespace App\Exceptions;

use Illuminate\Support\MessageBag;
use Exception;

class BaseException extends Exception
{
    /**
     * @var \Illuminate\Support\MessageBag
     */
    protected $messages;

    /**
     * @param string $erroMessage
     * @param int $errorCode
     * @param array $messages
     * @return void
     */
    public function __construct(
        string $errorMessage = 'App Exception',
        int $errorCode = 400,
        array $messages = []
    ) {
        parent::__construct($errorMessage, $errorCode);

        $this->messages = new MessageBag($messages);
    }

    /**
     * Show messages
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function getMessages()
    {
        return $this->messages;
    }
}