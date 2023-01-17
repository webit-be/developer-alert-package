<?php

namespace webit_be\developer_alert\app\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use webit_be\developer_alert\Models\Alert;

class AlertController extends Controller
{
    public function index(Request $request, $id)
    {   
        if (! $request->hasValidSignature()) {
            abort(401);
        }
        
        return view('settings.index')->with('alert', Alert::find($id));
    }

    public function update(Request $request, $id)
    {
        $alert = Alert::find($id);
        
        if ($request->snooze_until) {
            $alert->snoozed_until = Carbon::now()->addHours($request->snooze_until); 
        }

        if ($request->reset_snooze) {
            $alert->snoozed_until = null;
        }

        $alert->is_disabled = $request->disable;
        $alert->save();

        session()->flash('message', 'Settings zijn succesvol aangepast');
        return back();
    }
}