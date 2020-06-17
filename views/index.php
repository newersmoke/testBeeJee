<?php

class Autoloader
{
    public static function register()
    {
        //class directories
        $directorys = array(
            './classes/',
            './controllers/',
            './models/',
        );
       
        foreach($directorys as $directory)
        {
            $files = scandir($directory);
            
            foreach($files as $file){
                if(strpos($file, 'php') !== false && file_exists($directory.'/'.$file))
                {
                    include_once $directory.'/'.$file;
                }   
            }        
        }
    }
}
Autoloader::register();
session_start();
use System\Route as Route;

return Route::launch();

exit();