<?php

namespace App\Services;

use Joselfonseca\LaravelTactician\CommandBusInterface;
use App\Contracts\ServiceInterface;

abstract class BaseService implements ServiceInterface
{
    /**
     * @var \Joselfonseca\LaravelTactician\CommandBusInterface
     */
    protected $bus;

    /**
     * @var string
     */
    protected $commandName;

    /**
     * @var string
     */
    protected $handlerName;

    /**
     * @var array
     */
    protected $middlewares = [];

    /**
     * @param \Joselfonseca\LaravelTactician\CommandBusInterface $bus
     * @return void
     */
    public function __construct(CommandBusInterface $bus)
    {
        $this->bus = $bus;
    }

    /**
     * { @inheritdoc }
     */
    public function dispatch(array $params = [])
    {
        $this->bus->addHandler($this->commandName, $this->handlerName);
        return $this->bus->dispatch($this->commandName, $params, $this->middlewares);
    }
}