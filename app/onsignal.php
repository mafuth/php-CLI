<?php
class onesignal{
    private $APP_ID;
    private $APP_KEY;
    private $APP_ICON;
    private $APP_EMAIL;
    private $APP_SAFARI_WEB_ID;

    public function __construct($APP_ID,$KEY,$ICON,$SAFARI_WEB_ID,$EMAIL){
        $this->APP_ID = $APP_ID;
        $this->APP_KEY = $KEY;
        $this->APP_ICON = $ICON;
        $this->APP_SAFARI_WEB_ID = $SAFARI_WEB_ID;
        $this->APP_EMAIL = $EMAIL;
    }

    public function creatNotification($IDS,$title,$msg,$img){
        $msg = "";
        $img = "";
        $title = "";

        $content = array(
            "en" => $msg
        );
        $headings = array(
            "en" => $title
        );
        if ($img == '') {
            $fields = array(
                'app_id' => $this->APP_ID,
                "headings" => $headings,
                'include_player_ids' => $IDS,
                'large_icon' => $this->APP_ICON,
                'content_available' => true,
                'contents' => $content
            );
        } else {
            $ios_img = array(
                "id1" => $img
            );
            $fields = array(
                'app_id' => $this->APP_ID,
                "headings" => $headings,
                'include_player_ids' => array($to),
                'contents' => $content,
                "big_picture" => $img,
                'large_icon' => $this->APP_ICON,
                'content_available' => true,
                "ios_attachments" => $ios_img
            );

        }
        $KEY = $this->APP_KEY;
        $headers = array(
            "Authorization: Basic $KEY",
            'Content-Type: application/json; charset=utf-8'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    public function cancelNotification($NOTIFICATION_ID){ 
        $app_id = $this->APP_ID;
        $KEY = $this->APP_KEY;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/notifications/'.$NOTIFICATION_ID.'?app_id='.$app_id.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');


        $headers = array();
        $headers[] = "Authorization: Basic $KEY";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $result = 'Error:' . curl_error($ch);
        }
        curl_close($ch); 
        return $result;
    }
    public function getHistory(){
        $APP_ID = $this->APP_ID;
        $APP_MAIL = $this->APP_EMAIL;
        $KEY = $this->APP_KEY;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://app.onesignal.com/api/v1/notifications/{notification_id}/history');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n    \"events\": \"clicked\",\n    \"app_id\": \"$APP_ID\",\n    \"email\": \"$APP_MAIL\"\n}");

        $headers = array();
        $headers[] = "Authorization: Basic $KEY";
        $headers[] = 'Cache-Control: no-cache';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $result = 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }
    public function getDevices(){ 
        $app_id = $this->APP_ID;
        $KEY = $this->APP_KEY;
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/players?app_id=" . $app_id); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 
                                                   "Authorization: Basic $KEY")); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $response = curl_exec($ch); 
        curl_close($ch); 
        return $response; 
    }
    public function createCode($END_POINT,$VARIABLE,$AJAX_STATUS){ 
        $APP_ID = $this->$APP_ID;
        $APP_SAFARI_WEB_ID = $this->$APP_SAFARI_WEB_ID;
        if($AJAX_STATUS == false){
            $CODE = "
            <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
            <script>
            window.OneSignal = window.OneSignal || [];
            OneSignal.push(function() {
                OneSignal.init({
                appId: '$APP_ID',
                safari_web_id: 'web.onesignal.auto.$APP_SAFARI_WEB_ID',
                notifyButton: {
                    enable: true,
                },
                });
            });
            OneSignal.push(function() {
                OneSignal.isPushNotificationsEnabled(function(isEnabled) {
                    if (isEnabled)
                    {
                        OneSignal.push(function() {
                        OneSignal.getUserId(function(userId) {
                            $.ajax({
                                type:'POST',
                                url:'$END_POINT',
                                data:{
                                    $VARIABLE:userId,
                                }
                            });    
                        });
                            
                        OneSignal.getUserId().then(function(userId) {
                            $.ajax({
                                type:'POST',
                                url:'$END_POINT',
                                data:{
                                    $VARIABLE:userId,
                                }
                            });   
                        });
                    });
                    console.log('Push notifications are enabled!');
                    }
                    else
                    {
                        console.log('Push notifications are not enabled yet.'); 
                    }   
                });
                        
                OneSignal.isPushNotificationsEnabled().then(function(isEnabled) {
                    if (isEnabled)
                    console.log('Push notifications are enabled!');
                    else
                    {
                        console.log('Push notifications are not enabled yet.'); 
                    }     
                });
            });
            </script>
            ";
        }else{
            $CODE = "
            <script>
            window.OneSignal = window.OneSignal || [];
            OneSignal.push(function() {
                OneSignal.init({
                appId: '$APP_ID',
                safari_web_id: 'web.onesignal.auto.$APP_SAFARI_WEB_ID',
                notifyButton: {
                    enable: true,
                },
                });
            });
            OneSignal.push(function() {
                OneSignal.isPushNotificationsEnabled(function(isEnabled) {
                    if (isEnabled)
                    {
                        OneSignal.push(function() {
                        OneSignal.getUserId(function(userId) {
                            $.ajax({
                                type:'POST',
                                url:'$END_POINT',
                                data:{
                                    $VARIABLE:userId,
                                }
                            });    
                        });
                            
                        OneSignal.getUserId().then(function(userId) {
                            $.ajax({
                                type:'POST',
                                url:'$END_POINT',
                                data:{
                                    $VARIABLE:userId,
                                }
                            });   
                        });
                    });
                    console.log('Push notifications are enabled!');
                    }
                    else
                    {
                        console.log('Push notifications are not enabled yet.'); 
                    }   
                });
                        
                OneSignal.isPushNotificationsEnabled().then(function(isEnabled) {
                    if (isEnabled)
                    console.log('Push notifications are enabled!');
                    else
                    {
                        console.log('Push notifications are not enabled yet.'); 
                    }     
                });
            });
            </script>";
            return $CODE;
        }
    }
}