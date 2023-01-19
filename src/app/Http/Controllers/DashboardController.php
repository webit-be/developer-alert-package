<?php

namespace webit_be\developer_alert\app\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use webit_be\developer_alert\Models\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        $alerts = Alert::limit(20)->get();

        return view('developer_alert::dashboard.index')->with('alerts', $alerts);
    }
}