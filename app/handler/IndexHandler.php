<?php

namespace Reiko\App;

use Reiko\Libraries\Handler;
use ORM;

class IndexHandler extends Handler
{

  public function index()
  {
    $data['menus'] = ['Home'=> 'https://github.com/justalinko/reikoframework',
                      'Documentation' => 'https://github.com/justalinko/reikoframework', 
                      'Contribute' => 'https://github.com/justalinko/reikoframework',
                       'Donate' => 'https://github.com/justalinko/reikoframework'];
    $data['title'] = 'Reiko Framework';
    //  dd($data);
    $this->view('default', $data);
  }
}
