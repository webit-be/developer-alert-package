<?php

namespace webit_be\developer_alert\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as BaseHandler;
use Illuminate\Support\Facades\Log;
use Throwable;
class Handler extends BaseHandler
{
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            Log::info('called from throwable');
            Log::info($e);
        });
    }    
}