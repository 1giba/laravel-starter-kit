<?php

namespace App\Services\Users;

use App\Services\BaseService;
use App\Services\Users\Commands\ListUsers as Command;
use App\Services\Users\Handlers\ListUsers as Handler;

class ListUsers extends BaseService
{
    protected $commandName = Command::class;

    protected $handlerName = Handler::class;
}