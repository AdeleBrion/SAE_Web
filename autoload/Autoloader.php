<?php
namespace autoload;

class Autoloader{

    static function register(){
        spl_autoload_register(array(__CLASS__, "autoload"));
    }

    static function autoload($class){
        $path = str_replace("\\", DIRECTORY_SEPARATOR, $class);
        require_once $path . '.php';
    }
}

?>