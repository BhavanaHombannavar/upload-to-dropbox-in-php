<?php
/*$url = 'https://www.dropbox.com/oauth2/authorize';
$login = 'herbstjens4@gmail.com';
$password = 'testteam';

$client_id = 'rqcrbki2z0147eq';
$redirect_uri = 'http://localhost/dropbox/dropbox.php';
$client_secret = '0x425nf8jwyb977';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_POST, TRUE);

$code = 'ps5sR1QzYxwAAAAAAAAAAYEz9CUJ3FNqJE42UU62LhDt_q2OsRw6-_pyPBuIe4nm';

// This option is set to TRUE so that the response
// doesnot get printed and is stored directly in
// the variable
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($ch, CURLOPT_POSTFIELDS, array(
'code' => $code,
'client_id' => $client_id,
'client_secret' => $client_secret,
'redirect_uri' => $redirect_uri,
'grant_type' => 'authorization_code'
));

$data = curl_exec($ch);

var_dump($data);*/
$accessToken = 'ps5sR1QzYxwAAAAAAAAAAYEz9CUJ3FNqJE42UU62LhDt_q2OsRw6-_pyPBuIe4nm';

$path = "/";
$query = ".doc";
$start = 0;
$max_results = 50;
$filename = 'alu-template.png';


$api_url = 'https://content.dropboxapi.com/2/files/upload'; //dropbox api url

        $headers = array('Authorization: Bearer '. $accessToken,
            'Content-Type: application/octet-stream',
            'Dropbox-API-Arg: '.
            json_encode(
                array(
                    "path"=> '/newfloder/'. basename($filename),
                    "mode" => "add",
                    "autorename" => true,
                    "mute" => false
                )
            )

        );

        $ch = curl_init($api_url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);

        $path = 'local/'.$filename;
        $fp = fopen($path, 'rb');
        $filesize = filesize($path);

        curl_setopt($ch, CURLOPT_POSTFIELDS, fread($fp, $filesize));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_VERBOSE, 1); // debug

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        echo($response.'<br/>');
        echo($http_code.'<br/>');

        curl_close($ch);