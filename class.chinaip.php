<?php

class chinaip
{
    function chinaip() {
        header('content-type:text/html;charset=utf-8;');
        $this->path = dirname(__FILE__)."/class.chinaip.db";
        $content = file_get_contents($this->path);
        if(empty($content)) {
            exit('IP DATA ERROR');
        }
        $this->iptable = json_decode($content,true);
    }

    function getIp(){
        if (isset($_SERVER)){
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
                $IPaddress = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $IPaddress = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $IPaddress = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")){
                $IPaddress = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv("HTTP_CLIENT_IP")) {
                $IPaddress = getenv("HTTP_CLIENT_IP");
            } else {
                $IPaddress = getenv("REMOTE_ADDR");
            }
        }
        return $IPaddress;
    }

    function inChina($ip = '') {
        !$ip &&$ip = $this->GetIp();
        $tag = explode('.',$ip);//A.B.C.D 里面的A
        $tag = reset($tag);
        if(!$ip || !array_key_exists($tag,$this->iptable)) {
            return false; //IP ERROR
        }
        $ipLong = ip2long($ip);
        foreach($this->iptable[$tag] as $k =>$v) {
            if($v[0] <= $ipLong && $ipLong <= $v[1]) {
                return true;
            }
        }
        return false;
    }

    function __destruct() {
        unset($this->iptable);
    }
}
?>