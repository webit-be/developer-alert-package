<?php

namespace webit_be\developer_alert\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use webit_be\developer_alert\App\Mail\DeveloperAlertMail;
use webit_be\developer_alert\Models\Alert;

class DeveloperAlertService 
{
    public static function sendAlertMail($e, $where_from, $filename)
    {
        try {
            // Mail alert
            $trace = json_encode($e->getTrace(), JSON_PRETTY_PRINT);

            if (! Alert::checkIfAlertExists($e->getMessage(), $filename)) {

                $alert = Alert::create([
                    'error_message' => $e->getMessage(),
                    'where_from' => $where_from[count($where_from)-1]['line'],
                    'file' => $filename,
                    'stack_trace' => $trace,
                ]);

            } else {
                $alert = Alert::where('error_message', $e->getMessage())->where('file', $filename)->first();
                $alert->times_throwed = $alert->times_throwed += 1;
                $alert->save();
            }

            if (DeveloperAlertService::checkSendRequirements($alert)) {
                Mail::mailer('smtp')->to(config('alert.receiver_email'))->send(new DeveloperAlertMail($alert, $e->getMessage(), $where_from, $trace, $filename));
            }
            
            // Initiate openAI process to analyse & solve the error
            OpenAIService::solveError($e->getMessage(), $where_from, $trace, $filename);

            dd('stop');
            return;

        } catch(\Exception $e) {
            Log::error('Errorception');
            Log::info($e);
        }
    }

    public static function checkSendRequirements($alert)
    {
        if ($alert->is_disabled) {
            return false;
        }

        if (Carbon::now() < $alert->snoozed_until) {
            return false;
        }

        return true;
    }
}