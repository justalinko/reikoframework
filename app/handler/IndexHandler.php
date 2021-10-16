<?php

namespace Reiko\App;

use Reiko\Libraries\Handler;
use Reiko\Libraries\DB;

class IndexHandler extends Handler
{

  public function index()
  {
    $data['menus'] = ['Home'=> 'https://github.com/justalinko/reikoframework',
                      'Documentation' => 'https://github.com/justalinko/reikoframework', 
                      'Contribute' => 'https://github.com/justalinko/reikoframework',
                       'Donate' => 'https://github.com/justalinko/reikoframework'];
    $data['title'] = 'Reiko Framework';
    $this->view('default', $data);
  }
 
}
