<?php 
namespace webit_be\developer_alert\App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class DeveloperAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $alert;
    public $error_message;
    public $where_from;
    public $stack_trace;
    public $file;

    public function __construct($alert, $error_message, $where_from, $stack_trace, $file)
    {
        $this->alert = $alert;
        $this->error_message = $error_message;
        $this->where_from = $where_from[count($where_from)-1];
        $this->stack_trace = $stack_trace;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Generate the signed url's for the mail settings
        $snooze_url = URL::signedRoute('alert.snooze', ['id' => $this->alert->id]);

        return $this->view('developer_alert::mails.alert')->with(['snooze_url' => $snooze_url]);
    }
}