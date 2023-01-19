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

    public function __construct($alert)
    {
        $this->alert = $alert;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Generate the signed url's for the mail settings
        $snooze_url = URL::signedRoute('alert.settings', ['id' => $this->alert->id]);

        return $this->view('developer_alert::mails.alert')->with(['snooze_url' => $snooze_url]);
    }
}