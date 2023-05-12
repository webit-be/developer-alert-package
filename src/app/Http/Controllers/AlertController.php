<?php

namespace webit_be\developer_alert\app\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use webit_be\developer_alert\Models\Alert;
use webit_be\developer_alert\Models\Prompt;
use webit_be\developer_alert\Services\FileService;
use webit_be\developer_alert\Services\OpenAIService;


class AlertController extends Controller
{
    public function index(Request $request, $id)
    {   
        // if (! $request->hasValidSignature()) {
        //     abort(401);
        // }
        
        return view('developer_alert::settings.index')->with('alert', Alert::find($id));
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

    public function solve($id)
    {
        $alert = Alert::find($id);

        // Fetch the code that cause the error
        $code = FileService::fetchRelatedCode($alert->where_from, $alert->function);

        return view('developer_alert::solving.index')->with('alert', $alert)->with('code', $code);
    }

    public function prompt(Request $request, $id)
    {
        $alert = Alert::find($id);
        $answer = OpenAIService::solveError($alert->error_message, $alert->where_from, $alert->function, null, $request->option);

        if ( $answer == false ) {
            alert("OpenAIservice returned false");
        }

        // save prompt in the database
        // $prompt = new Prompt([
        //     'text_bot' => $answer['choices'][0]['text'],
        //     'alert_id' => $id
        // ]);
        // $prompt->save();

        return response($answer, 200)->json($answer['choices'][0]['text']);
    }

    public function changeStatus($id)
    {
        $alert = Alert::find($id);
        $status = $alert->status;

        if ( $status == 'Open' ) {
            $alert->update( ["status" => "Solved"] );
        }
        else {
            $alert->update( ["status" => "Open"] );
        }

        return back();
    }
}