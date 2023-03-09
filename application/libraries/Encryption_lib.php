<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Encryption_lib {
    var $skey = "PortalDesa99999"; // you can change it

    public  function safe_b64encode($string) {
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }

    public function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    public  function encode($value){ 
        if(!$value){return false;}

        $CI =& get_instance();
        $CI->load->library('encryption');
        $CI->encryption->initialize(
            array(
                'cipher' => 'aes-256',
                'mode' => 'ctr',
                'key' => $this->skey
            )
        );
        $hasil = $CI->encryption->encrypt($value);
        return trim($this->safe_b64encode($hasil)); 
    }

    public function decode($value){
        if(!$value){return false;}
        
        $CI =& get_instance();
        $CI->load->library('encryption');
        $CI->encryption->initialize(
            array(
                'cipher' => 'aes-256',
                'mode' => 'ctr',
                'key' => $this->skey
            )
        );
        $hasil = $CI->encryption->decrypt( $this->safe_b64decode($value) );
        return trim($hasil); 
    }
}