<?php

namespace webit_be\developer_alert\app\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as BaseHandler;
use Illuminate\Support\Facades\Log;

class Handler extends BaseHandler
{
    public function register()
    {
        Log::info('register called in package');
    }    
}