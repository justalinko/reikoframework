<?php

function dbfun($dbname)
{
    return (new $dbname);
}
function slug($string, $split = '-')
{
    $slug = strtolower(trim(preg_replace('/[\s-]+/', $split, preg_replace('/[^A-Za-z0-9-]+/', $split, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $string))))), $split));
    return $slug;
}
function is_db_connected()
{
    $conn = mysqli_connect($_ENV['DB_HOSTNAME'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE']);
    if ($conn) {
        return true;
    } else {
        return false;
    }
}
function get_time_rendered()
{

    if (defined('REIKO_START')) {
        $start = REIKO_START;
        $end = microtime();
        $calc = ($end - $start);

        return round($calc, 4) . ' Seconds';
    } else {
        return 'null';
    }
}
function env_check()
{
    if (file_exists(dirname(dirname(__DIR__)) . '/.env')) {
        return $_ENV['APP_ENVIRONMENT'];
    } else {
        return 'Not configured';
    }
}
