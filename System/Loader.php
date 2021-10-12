<?php

if(!isset($config['path']))
{
    echo 'Don\'t path Files for Loader';
    exit;
}

$projectAutoloader = function ($class_name)  use ($config)
{
    foreach($config['path'] as $item)
    {
        if(file_exists($path = $item.$class_name . '.php'))
        {
            include $path;
            break;
        }
    }
};

spl_autoload_register($projectAutoloader);