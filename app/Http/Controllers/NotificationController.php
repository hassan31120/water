<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function noti()
    {
        return view('admin.notifications.index');
    }

    public function push(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $noti = $request->all();

        $users = User::all();

        $SERVER_API_KEY = 'AAAAQB6Rw28:APA91bHOOMRW6SGa8PDmKtfX5S6XI1ztlUMCnzSs4Py0ONEbKY-8YjMf-U5Oyu7_amZiJtpuq8i3A-qjIHL1mSECva_KBvt9Kxlj1IqyzFAf3ZOhybwKDP-Zc5ghF1JpIZNBNs1GIjxf';

        // $token_1 = 'caD1lbZPTQu4CjP64vtoiz:APA91bE503t28_Al6INNcQuzqh-E1xoCxEslVCYS0DZgkUtyYcKxOxR4uJ-eTJLP9Er7kHkIx8M5k5eOjlCpdQQV3RxGr0dC901KQww43RMudZFAVoLO1LoJ-IeQCWZzQ99TIBx29VS8';
        // $token_2 = 'caD1lbZPTQu4CjP64vtoiz:APA91bE503t28_Al6INNcQuzqh-E1xoCxEslVCYS0DZgkUtyYcKxOxR4uJ-eTJLP9Er7kHkIx8M5k5eOjlCpdQQV3RxGr0dC901KQww43RMudZFAVoLO1LoJ-IeQCWZzQ99TIBx29VS8';

        $token = [];
        foreach ($users as $user) {
            // $token_1 = $user->push_token;
            array_push($token, $user->push_token);
        }


        $data = [

            "registration_ids" => 
                $token,

            "notification" => [

                "title" => $noti['title'],

                "body" => $noti['body'],

                "sound" => "default", // required for sound on ios

                "image" => $noti['image']

            ],

            "data" => [

                "click_action" => "FLUTTER_NOTIFICATION_CLICK"

            ],

        ];


        $dataString = json_encode($data);

        $headers = [

            'Authorization: key=' . $SERVER_API_KEY,

            'Content-Type: application/json',

        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);


        $response = curl_exec($ch);

        return redirect()->back()->with('success', 'تم  إرسال الإشعار بنجاح');
    }
}
