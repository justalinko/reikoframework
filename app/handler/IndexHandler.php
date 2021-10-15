<?php
namespace Reiko\App;

use Reiko\Libraries\Handler;

class IndexHandler extends Handler{

    public function index()
    {
        $this->view('default');
    }
}