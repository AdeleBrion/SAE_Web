<?php

class AutoLoader {

    static function register() {
        sql_autoload_register(array(__CLASS__, "autoload"));
    }

    static function autoload($class) {
        $path = str_replace("\\","/", $class);
        return "Classes/".$path;
    }
}

?>