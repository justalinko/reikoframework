<?php
namespace Reiko\App;

use Reiko\Libraries\Handler;
use ORM;

class IndexHandler extends Handler{

    public function index()
    {
        $data['items'] = ['Home' , 'Docs' , 'Contribute' ,'Donate' ];
        $this->view('default',$data);
    }
}