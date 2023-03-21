<?php

namespace webit_be\developer_alert\app\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use webit_be\developer_alert\Models\Alert;
use Illuminate\Support\Facades\Storage;
use webit_be\developer_alert\app\Http\Controllers\DashboardController;

class ArchiveController extends Controller
{
    public function index()
    {
        // orderBy('status', 'asc') toegevoegd door Jef, zet de alerts met status 'Open' bovenaan
        $archivedAlerts = Alert::withTrashed()->whereNotNull('deleted_at')->get();

        return view('developer_alert::archive.index')->with('archivedAlerts', $archivedAlerts);
    }

    public function archive($id)
    {
        $alert = Alert::find($id);
        $alert->delete();

        return back();
    }

    public function restore($id)
    {
        $alert = Alert::withTrashed()->where('id', $id)->restore();

        return back()->with('success', 'Alert is restored');
    }
}