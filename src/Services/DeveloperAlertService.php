<?php

namespace webit_be\developer_alert\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use webit_be\developer_alert\App\Mail\DeveloperAlertMail;
use webit_be\developer_alert\Models\Alert;

class DeveloperAlertService 
{
    public static function sendAlertMail($e, $where_from)
    {
        try {
            // Mail alert
            $trace = json_encode($e->getTrace(), JSON_PRETTY_PRINT);

            $full_path = base_path() . '/' . str_replace('\\', '/', $where_from[0]['class']) . '.php';
            
            if (! Alert::checkIfAlertExists($e->getMessage(), $full_path, $where_from[0]['function'])) {

                $alert = Alert::create([
                    'error_message' => $e->getMessage(),
                    'where_from' => $full_path,
                    'function' => $where_from[0]['function'] ?? '',
                    'stack_trace' => $trace,
                ]);

            } else {
                $alert = Alert::where('error_message', $e->getMessage())->where('where_from', $full_path)->where('function', $where_from[0]['function'])->first();
                $alert->times_throwed = $alert->times_throwed += 1;
                $alert->save();
            }

            if (DeveloperAlertService::checkSendRequirements($alert)) {
                Mail::mailer('smtp')->to(config('alert.receiver_email'))->send(new DeveloperAlertMail($alert));
            }
            
            // Initiate openAI process to analyse & solve the error
            // OpenAIService::solveError($e->getMessage(), $alert->where_from, $trace, $filename);

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

    public static function triggerError()
    {
        try {
            trigger_error("Oops!", E_USER_ERROR);
        } catch (\Exception $e) {
            DeveloperAlertService::sendAlertMail($e, debug_backtrace(), basename(FILE, '.php'));
        }
    }
}