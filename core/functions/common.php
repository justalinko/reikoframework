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

function dd($data){
    $data = var_dump($data);
    highlight_string("<?php\n " . var_export($data, true) . "?>");
    echo '<script>document.getElementsByTagName("code")[0].getElementsByTagName("span")[1].remove() ;document.getElementsByTagName("code")[0].getElementsByTagName("span")[document.getElementsByTagName("code")[0].getElementsByTagName("span").length - 1].remove() ; </script>';
    die();
}
  
function debug($var,$show = false) {
    if($show) { $dis = 'block'; }else { $dis = 'none'; }
    ob_start();
    echo '<div style="display:'.$dis.';text-align:left; direction:ltr;"><b>Idea Debug Method : </b>
        <pre>';
    if(is_bool($var)) {
        echo $var === TRUE ? 'Boolean(TRUE)' : 'Boolean(FALSE)';
    }else {
        if(FALSE == empty($var) && $var !== NULL && $var != '0') {
            if(is_array($var)) {
                echo "Number of Indexes: " . count($var) . "\n";
                print_r($var);
            } elseif(is_object($var)) {
                print_r($var);
            } elseif(@is_file($var)){
                $stat = stat($var);
                $perm = substr(sprintf('%o',$stat['mode']), -4);
                $accesstime = gmdate('Y/m/d H:i:s', $stat['atime']);
                $modification = gmdate('Y/m/d H:i:s', $stat['mtime']);
                $change = gmdate('Y/m/d H:i:s', $stat['ctime']);
                echo "
    file path : $var
    file size : {$stat['size']} Byte
    device number : {$stat['dev']}
    permission : {$perm}
    last access time was : {$accesstime}
    last modified time was : {$modification}
    last change time was : {$change}
    ";
            }elseif(is_string($var)) {
                print_r(htmlentities(str_replace("\t", '  ', $var)));
            }  else {
                print_r($var);
            }
        }else {
            echo 'Undefined';
        }
    }
    echo '</pre>
    </div>';
    $output = ob_get_contents();
    ob_end_clean();
    echo $output;
    unset($output);
}