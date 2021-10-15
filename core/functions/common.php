<?php

function base_url(){
    
    if(isset($_ENV['APP_BASEURL'])){
        return $_ENV['APP_BASEURL'];
    }else{
        return 'http://localhost:8888';
    }
}

function redirect($to , $delay = 0)
{
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='$delay;url=$to'>";
}

function session($name)
{
    if(isset($_SESSION[$name]))
    {
        return $_SESSION[$name];
    }else{
        return null;
    }
}

function set_session($arr = [])
{

    if(is_array($arr))
    {
        foreach($arr as $key=>$val)
        {
            $_SESSION[$key] = $val;
        }
    }
}

function remove_session($name)
{
    if(isset($_SESSION[$name]))
    {
         unset($_SESSION[$name]);
    }else{
        return false;
    }
}

 function assets($files)
{

    return base_url().'/assets/'.$files;
}