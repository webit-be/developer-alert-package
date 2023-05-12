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
        // orderBy('status', 'asc') toegevoegd door Jef, zet de alerts met status 'Open' bovenaan
        $alerts = Alert::withTrashed(20)->orderBy('status', 'asc')->get();
        $trashedAlerts = Alert::withTrashed()->get();

        return view('developer_alert::dashboard.index')->with('alerts', $alerts)->with('trashedAlerts', $trashedAlerts);
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