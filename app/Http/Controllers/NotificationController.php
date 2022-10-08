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

        if ($request->hasFile('noti_image')) {
            $file = $request->file('noti_image');
            $filepath = 'storage/images/noti/' . date('Y') . '/' . date('m') . '/';
            $filename = $filepath . time() . '-' . $file->getClientOriginalName();
            $file->move($filepath, $filename);
            $noti['noti_image'] = $filename;
            foreach($users as $user){
                $user->noti_image = $filename;
                $user->save();
            }
        }

        $SERVER_API_KEY = 'AAAAuZcnJWg:APA91bFvOGDK9Ap2yOSEYsQP9R-aIpFUhkFx7j7T_yjlOENQKnMG4JPPOumjHr3XjXcqaD5Zlk4rhzjJEEzDuBq_4irgQMCF39SfeNtAMIdLtlBF5JMQWGShLiYdjM9btt69PK9bJA7j';

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

                "image" => asset($noti['noti_image'])

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
