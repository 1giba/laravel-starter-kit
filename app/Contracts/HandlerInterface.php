<?php

namespace App\Contracts;

interface HandlerInterface
{
    /**
     * Method of handler
     *
     * @param \App\Contracts\CommandInterface $command
     * @return mixed
     */
    public function handle(CommandInterface $command);
}