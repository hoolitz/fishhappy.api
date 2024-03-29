<?php
namespace App\Helper;

trait FirebaseHelper {

    //protected function pushNotification($tokens, $payload)
    protected function pushNotification($tokens, $payload)
    {

        //$data=[];
        //$data['message']= "Some message";
        //$data['booking_id']="my booking booking_id";

        //$tokens = [];
        //$tokens[] = 'ekgg0nU9QX2P6w5uJYkqOv:APA91bGeIKDw1zrERzl62bWJsDSdJkZsM5xHLJMlyDWMuoxW4ysuodFnRv_VJZu2FGBtksi_EE-TilFL1htKpWGs3TMme1Pc9jIeXeT3MscX1rTax68ywj_VrrrC9etaf0xkCRuUJTev';
        $response = $this->sendFirebasePush($tokens,$payload);

        //RETURN THE RESPONSE
        return $response;
    }

    public function sendFirebasePush($tokens, $data)
    {

        // prep the bundle
        $msg = array
        (
            'message'   => $data['message'],
        );

        $notifyData = [
            "title"=> $data['title'],
            "body" => $data['body']
        ];

        $registrationIds = $tokens;

        if(count($tokens) > 1) {
            $fields = array
            (
                'registration_ids' => $registrationIds, //  for  multiple users
                'notification'  => $notifyData,
                'data'=> $msg,
                'priority'=> 'high'
            );
        }
        else{

            $fields = array
            (
                'to' => $registrationIds[0], //  for  only one users
                'notification'  => $notifyData,
                'data'=> $msg,
                'priority'=> 'high'
            );
        }

        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='.env('SERVER_KEY','none');

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        // curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        if ($result === FALSE)
        {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close( $ch );
        return $result;
    }


}
