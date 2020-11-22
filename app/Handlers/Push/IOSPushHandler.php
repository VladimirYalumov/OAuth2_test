<?php

namespace App\Handlers\Push;

use App\Handlers\AbstractPushHandler;

class IOSPushHandler extends AbstractPushHandler
{

protected $key = <<<EOF
-----BEGIN PRIVATE KEY-----
MIGTAgEAMBMGByqGSM49AgEGCCqGSM49AwEHBHkwdwIBAQQg/cUXD1arTPpEf8IS
TCsFqHb4bVxFAdskbDU/KiSK54SgCgYIKoZIzj0DAQehRANCAAR5D06ijl9WnNjg
KUowqd5sTKEd6tgDvK0RAeWXXZV5oFvN4NcmF6bd7tnEI0ScEt4p1vaxYq1CPduA
hHrZnABU
-----END PRIVATE KEY-----
EOF;

protected $url = "https://api.development.push.apple.com";

    public function sendPush()// : bool
    {
        $keyid = 'T926C35KST';
        $teamid = '8STWH2P2W9';
        $bundleid = 'RamilSalimov.DeeWave';

        $message = '{"aps":{"alert":"You Pider!","sound":"default"}}';

        $key = openssl_pkey_get_private($this->key);

        $header = ['alg'=>'ES256','kid'=>$keyid];
        $claims = ['iss'=>$teamid,'iat'=>time()];
    
        $header_encoded = $this->base64($header);
        $claims_encoded = $this->base64($claims);
    
        $signature = '';
        openssl_sign($header_encoded . '.' . $claims_encoded, $signature, $key, 'sha256');
        $jwt = $header_encoded . '.' . $claims_encoded . '.' . base64_encode($signature);

        $http2ch = curl_init();
        curl_setopt_array($http2ch, array(
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
            CURLOPT_URL => $this->url."/3/device/".$this->pushToken,
            CURLOPT_PORT => 443,
            CURLOPT_HTTPHEADER => array(
            "apns-topic: {$bundleid}",
            "authorization: bearer $jwt"
            ),
            CURLOPT_POST => TRUE,
            CURLOPT_POSTFIELDS => json_encode($message),
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HEADER => 1,
            CURLOPT_SSL_VERIFYPEER => false
        ));
        //curl_setopt($http2ch, CURLOPT_CAINFO, base_path().'\certs\DeeWavePushDev.pem');
        //curl_setopt($http2ch, CURLOPT_CAPATH, base_path().'\certs\DeeWavePushDev.pem');

        return curl_exec($http2ch);
    }

    private function base64($data) {
        return rtrim(strtr(base64_encode(json_encode($data)), '+/', '-_'), '=');
    }
}