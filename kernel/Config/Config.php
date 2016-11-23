<?php
namespace Kernel\Config;

class Config {

    private static $_instance;
    // Je place un tableau vide dans $settings
    private $settings = [];

    // Design pattern singleton comme pour App
    public static function getInstance($file) {
        if(is_null(self::$_instance)) {
            self::$_instance = new Config($file);
        }
        return self::$_instance;
    }

    public function __construct($file) {
        $this->settings =  require($file);
    }

    public function get($key) {
        // get('db_name');
        return $this->settings[$key];
    }




}