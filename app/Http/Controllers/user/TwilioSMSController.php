<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class TwilioSMSController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function send()
    {

        $users = User::all();
        foreach ($users as $user) {

            $receiverNumber = $user->phone;
            //  dd($receiverNumber);

            $message = "This is testing from Ankan Das Twillo SMS.Do not panic!!";

            $accountSid = config('TWILIO_ACCOUNT_SID');
            $authToken = config('TWILIO_AUTH_TOKEN');
            $twilioNumber = config('TWILIO_NUMBER');



            // $accountSid = "ACaf2128c9843a46592b2846e185d4c4dd";
            // $authToken = "7da146102acab32bfd9308538940385d";
            // $twilioNumber = "+16782925239";

            $client = new Client($accountSid, $authToken);

            try {
                $client->messages->create(
                    $receiverNumber,
                    [
                        "body" => $message,
                        "from" => $twilioNumber
                    ]
                );
                dd("Message has been send!.");
            } catch (TwilioException $e) {
                Log::error(
                    'Could not send SMS notification.' .
                        ' Twilio replied with: ' . $e
                );
            }
        }
    }
}
