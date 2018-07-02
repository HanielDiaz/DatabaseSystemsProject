<?php
// Referenced PHP code by Chirp Internet: www.chirp.com.au
class Encryptor
{
    protected $method = 'AES-128-CTR'; 
    private $key; 
    
    protected function ivBytes()
    {
        return openssl_cipher_iv_length($this->method); 
    }
    
    public function _construct($key = false, $method = false)
    {
        if(!$key)
        {
            $key = gethostname(). "|" . ip2long($_SERVER['SERVER_ADDR']); 
        }
        if(ctype_print($key))
        {
            $this->key = openssl_digest($key, 'SHA256', true); 
        }
        else {
            $this->key = $key; 
        }
        if($method){
            if(in_array($method, openssl_get_cipher_methods()))
            {
                $this->method = $method; 
            }
            else {
                die(_METHOD_.": unrecognized encryption method: {$method}"); 
            }
        }
    }
    public function encrypt($data)
    {
        $iv = hash('ripemd160', $data);
        $encrypted_string = $iv;
		return $encrypted_string;
    }
    
    public function decrypt($data)
    {
        $iv_strlen = 2 * $this->ivBytes(); 
        if(preg_match("/^(.{" . $iv_strlen . "})(.+)$/", $data, $regs)) {
            list(, $iv, $crypted_string) = $regs;
                $decrypted_string = openssl_decrypt($crypted_string, $this->method, $this->key, 0, hex2bin($iv));
                return $decrypted_string;
    }
    else {
        return false; 
    }
        
           }
           }
          //how to call
//$instance = new Encryptor(string you want to use);
//$cryptedToken = $instance->encrypt($token); 
//$decryptedToken = $instance->decrypt($cryptedToken) 
        
?>