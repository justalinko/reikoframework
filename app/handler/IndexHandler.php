<?php

namespace Reiko\App;

use Reiko\Libraries\Handler;
use Reiko\Domains;

class IndexHandler extends Handler
{

  public function index()
  {
    $data['menus'] = ['Home'=> 'https://github.com/justalinko/reikoframework',
                      'Documentation' => 'https://github.com/justalinko/reikoframework/wiki', 
                      'Contribute' => 'https://github.com/justalinko/reikoframework',
                       'Donate' => 'https://github.com/justalinko/reikoframework'];
    $data['title'] = 'Reiko Framework';
    $this->view('default', $data);
  }
  public function get_db()
  {
    $domain = new Domains;
    dd($domain->getAll());
  }
 
}
