<?php 


class Session {

    public function __construct(){
        $this->init();
    }
    public static function init(){
        session_start();
        session_regenerate_id();
    }
    public static function get($key){
        return $_SESSION[$key];
    }

    public static function set($key, $value){
        return $_SESSION[$key] = $value;
    }

    public static function check($key){
        if(isset($_SESSION[$key])){
            return true;
        }else{
            return false;
        }
    }


}