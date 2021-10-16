<?php

function parse_attribute($arr)
{
    $attr="";
    if(is_array($arr))
    {
        foreach($arr as $key=>$val)
        {
            $attr.= " {$key}=\"{$val}\"  ";
        }

    }

    return $attr;
}

function form_open($method = 'POST', $action = '/' , $attr = [])
{
    $forms = "<form method=\"{$method}\" action=\"{$action}\" ";
    $forms.= parse_attribute($attr);
    $forms.= "><!-- forms open ReikoFramework -->";

    return $forms;
}

function form_close()
{
    return "</form>";
}

function input($type = 'text' , $name = 'name' , $value = 'value' , $attr = [])
{
    $input = "<input type=\"{$type}\" name=\"{$name}\" value=\"$value\" ";
    $input.= parse_attribute($attr);
    $input.=" ><!-- input reikoframework -->";
    return $input;
}

function input_text($name,$value,$attr =[])
{
    return input('text',$name,$value,$attr);
}
function input_number($name,$value,$attr = [])
{
    return input('number' , $name,$val,$attr);
}
function input_tel($name,$value,$attr = [])
{
    return input('tel' , $name,$value,$attr);
}
function input_hidden($name,$value,$attr = [])
{
    return input('hidden' , $name,$value,$attr);
}
function input_group($data = [])
{
    $group = "<div id=\"input_group\">";
    foreach($data as $name=>$d)
    {
        $group.= input($d['type'] , $name , $d['value'] , $d['attr']);
    }
    $group .="</div>";

    return $group;
}