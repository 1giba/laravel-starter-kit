<?php

namespace App\Services\Users\Handlers;

use App\Contracts\HandlerInterface;
use App\Contracts\CommandInterface;
use App\Repositories\UserRepository;

class ListUsers implements HandlerInterface
{
    /**
     * @var \App\Repositories\UserRepository
     */
    protected $userRepository;

    /**
     * @param \App\Repositories\UserRepository $userRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * { @inheritdoc }
     */
    public function handle(CommandInterface $command)
    {

    }
}