<?php

namespace Reiko\App;

use Reiko\Libraries\Handler;
use Reiko\Domains;

class IndexHandler extends Handler
{

  public function index()
  {
    $data['menus'] = [
      'Home' => 'https://reikophp.justalinko.com',
      'Documentation' => 'https://reikophp.justalinko.com/docs/introduction/what-is-reiko',
      'Contribute' => 'https://github.com/justalinko/reikoframework/pulls',
      'Donate' => 'https://github.com/justalinko/reikoframework'
    ];
    $data['title'] = 'Reiko Framework';
    $this->view('default', $data);
  }
}
