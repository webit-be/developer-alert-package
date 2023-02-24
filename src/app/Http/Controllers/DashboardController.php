<?php

namespace webit_be\developer_alert\app\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use webit_be\developer_alert\Models\Alert;
use Illuminate\Support\Facades\Storage;
use webit_be\developer_alert\Services\DeveloperAlertService;

class DashboardController extends Controller
{
    public function index()
    {
        $alerts = Alert::limit(20)->get();

        return view('developer_alert::dashboard.index')->with('alerts', $alerts);
    }

    public function downloadLogs(Request $request)
    {
        $path = storage_path('logs/laravel.log');
        return response()->download($path);
    }

    public function triggerAlert() 
    {
        return DeveloperAlertService::triggerError($e, $where_from); 
    }
}