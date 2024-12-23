<?php
class Opensslencryptdecrypt
{
    public $secret_key = 'wG0lBWkGh0eigwbVn2NNless1v7rb9yF';
    public $secret_iv  = 'kZ9rGZG1BSssG1wUKXDD4ADdQ0d4TrOD';
    public $method  = "AES-256-CBC";

    function encrypt($string)
    {
        $output = false;
        $key = hash('sha256', $this->secret_key);
        $iv = substr(hash('sha256', $this->secret_iv), 0, 16);
        
        $output = openssl_encrypt($string, $this->method, $key, 0, $iv);
        
        // Validasi jika output false atau kosong
        if ($output === false || empty($output)) {
            return false;
        }

        $output = base64_encode($output);
        return $output;
    }

    function decrypt($string)
    {
        $output = false;
        $key = hash('sha256', $this->secret_key);
        $iv = substr(hash('sha256', $this->secret_iv), 0, 16);

        $decoded_string = base64_decode($string);

        // Validasi jika decoding gagal
        if ($decoded_string === false || empty($decoded_string)) {
            return false;
        }

        $output = openssl_decrypt($decoded_string, $this->method, $key, 0, $iv);

        // Validasi jika output false atau kosong
        if ($output === false || empty($output)) {
            return false;
        }

        return $output;
    }
    
}

    
