<?php namespace Site\Events\Mailers;

use App;
use Config;
use Mail;
use Site\Contact\Models\Message;
use Site\Events\Models\Registration;

class RegistrationMailer
{
    /**
     * @param Registration $registration
     */
    public static function send(Registration $registration)
    {
        if (App::environment('testing')) {
            // return;
        }

        $recipient = new \stdClass();
        $recipient->email = $registration->email;
        $recipient->name = trim($registration->name . ' ' . $registration->surname);

        $template = 'site.events::mail.registration';
        $templateParameters = [
            'site' => Config::get('app.url'),
            'registration' => $registration,
            'event' => $registration->event,
        ];

        Mail::send($template, $templateParameters, function ($message) use ($recipient) {
            $message->to($recipient->email, $recipient->name);
        });
    }
}
