<?php
$dir = __DIR__.'/command/';
$files = glob($dir . '/*.php');

foreach ($files as $file) {
    require($file);   
}
