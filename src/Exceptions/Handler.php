<?php

namespace webit_be\developer_alert\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as BaseHandler;
use Illuminate\Support\Facades\Log;
use webit_be\developer_alert\Models\Alert;

class Handler extends BaseHandler
{
    public function register()
    {
        $this->reportable(function (Throwable $e) {

            // Report the alert in the alerts table

            if (Alert::where('message', $e->getMessage())->where('where_from', $e->getFile())->exists()) {
                $alert = Alert::create([
                    'error_message' => $e->getMessage(),
                    'where_from' => $e->getFile(),
                    'from_handler_extension' => 1,
                ]);
            } else {
                $alert = Alert::where('error_message', $e->getMessage())->where('where_from', $e->getFile())->first();
                $alert->times_throwed = $alert->times_throwed += 1;
                $alert->save();
            }
        });
    }
}
