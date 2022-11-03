
<?php
$path = "https://api.telegram.org/bot<Your Bot Token>/";
$update = json_decode(file_get_contents("php://input"), TRUE); 

$chatId = $update["message"]["chat"]["id"];
$message =  $update["message"]["text"];
$first = $update["message"]["from"]["first_name"];
$last = $update["message"]["from"]["last_name"];
$callback_query = $update['callback_query'];
 

//***********************************************

$buttons = json_encode(
    [ 'keyboard' =>
        [ 
          
            ['📁 Upload Photo'],
        ],
        'resize_keyboard'=>true,
    ]);
        



//************************   START MAIN   ****************************
if($message=="/start"){
    $msg= 
        array(
            'chat_id' => $chatId, 
            'text' =>"Welcome,  ".$first
            ."\nHoran OCR - free Text from Image Scanner \n", 
            'parse_mode' => 'HTML',
            'reply_markup' =>$buttons,
            'disable_web_page_preview' => false);
    //'reply_markup' =>$print,
    send("sendMessage", $msg);  
    }  
//************************   START MAIN   ****************************
if($message=="📁 Upload Photo"){
    $msg= 
        array(
            'chat_id' => $chatId, 
            'text' =>"✅Crop part of image you want to translate and send here.

NB: ● Only Image with English Text Supported. 
● Accuracy is low for large text or low quality images", 
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => false);
     
    send("sendMessage", $msg); 
    }
//************************   TEXT LISTNER  ****************************
if($message !="/start" and $message !="")
                        {
                            $msg2= 
        array(
            'chat_id' => $chatId, 
            'text' =>"Ok, now send the image to scan...", 
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => false);
   
    send("sendMessage", $msg2); 
                        }



//************************   UPLOAD IMAGE  ****************************
if($update['message']['photo'][1]['file_id'])
    {
            $file_id=$update['message']['photo'][1]['file_id'];
            $geturl=$path."getFile?file_id=".$file_id;
            $file_path_json=file_get_contents($geturl);
            $file_path_json=json_decode($file_path_json, true);
            $file_path=$file_path_json['result']['file_path'];
            $filepath="https://api.telegram.org/file/bot<Your Bot Token>/".$file_path; 
            // Initialize a file URL to the variable
            $url = $filepath;
            $file_name = basename($url); 
            if (file_put_contents('images/'.$file_name, file_get_contents($url)))
            { 
                // Change url to place you want to store uploaded images
                $id_url= 'https://www.yourdomain.com/path/folder/'.$file_name;
                echo "File downloaded successfully"; 
                $wait=  
                    array( 
                        'chat_id' => $chatId, 
                        'text' =>"Processing, please wait....",  
                        'parse_mode' => 'HTML');
                send("sendMessage", $wait);
            }
            else
                {
                    $wait=  
                    array( 
                        'chat_id' => $chatId, 
                        'text' =>"Server Error, Downloading faild Try again....",  
                        'parse_mode' => 'HTML',
                        'disable_web_page_preview' => false);
                send("sendMessage", $wait);
                }
        
            $result = file_get_contents('http://api.ocr.space/parse/imageurl?apikey=K86055456288957&url='.$id_url);
            $result=json_decode($result, true);
            $str='';
            foreach($result['ParsedResults'] as $pareValue) 
                {
                            $str.= strval($pareValue['ParsedText']);
                }
                if($str!=""){ 
                $re= 
                array(
                'chat_id' => $chatId, 
                'text' => "🔍Scanned Text:\n$str\n\n@horansoftware",
                'disable_web_page_preview' => false,);
                    send("sendMessage", $re);
                }
                else{
                    $error=  
                    array( 
                        'chat_id' => $chatId, 
                        'text' =>"Server Error, Translating faild Try again...\nNB: only Image with English Text Supported",  
                        'parse_mode' => 'HTML',
                        'disable_web_page_preview' => false);
                    send("sendMessage", $error);
                }
        
        

}
function send($method, $data)
{  
    $url = "https://api.telegram.org/bot5723872215:AAHHtz77we-iXpiL-w4zf7bFwi-MU4Oeh-0/".$method;
    if (!$curld = curl_init()) {
        exit;
    }
    curl_setopt($curld, CURLOPT_POST, true);
    curl_setopt($curld, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curld, CURLOPT_URL, $url);
    curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($curld);
    curl_close($curld);
    return $output;
}




