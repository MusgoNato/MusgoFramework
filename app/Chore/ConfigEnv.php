<?php


namespace App\Chore;

class ConfigEnv
{
    protected static $items = [];


    /**
     * Summary of load
     * @return void
     */
    public static function load(string $path)
    {
        foreach(glob($path . '/*.php') as $file)
        {
            $key = basename($file, '.php');
            self::$items[$key] = require $file;   
        }
    }

    public static function get(string $key, $default = null)
    {
        $keys = explode('.', $key);
        $config = self::$items;

        foreach($keys as $segment)
        {
            if(!isset($config[$segment]))
            {
                return;
            }          

            $config = $config[$segment];
        }

        return $config;
    }
}
