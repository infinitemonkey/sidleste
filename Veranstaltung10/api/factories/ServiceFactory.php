<?php

class ServiceFactory implements IServiceFactory {

    private static $instance = NULL;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!self::$instance)
        {
            self::$instance = new ServiceFactory();
        }

        return self::$instance;
    }


    public function getService($service)
    {
        switch($service) {
            case 'kantone':
                return new KantoneDataService();
                break;
            default:
                return null;
        }

    }
}