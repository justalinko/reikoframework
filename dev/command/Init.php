<?php
namespace Dev\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class Init extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:init';
    protected static $defaultDescription = 'Setting environment variables';
    protected function configure(): void
    {
       
        $this->addOption('base-url' , null, InputOption::VALUE_OPTIONAL , 'Setting the base_url configuration');
        $this->addOption('database' , null, InputOption::VALUE_OPTIONAL , 'Setting the database configuration --database=host,user,pass,dbname');

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
      $base = $input->getOption('base-url');
      $db = $input->getOption('database');
      $this->configurenv($base,$db);

      return Command::SUCCESS;
      
    }
    protected function set($env,$change,$content)
    {
        return preg_replace("/".$env."?=?(.*)?/","{$env} = {$change}" , $content);
    }
    protected function configurenv($baseurl,$db)
    {
        if($baseurl == null){ $baseurl = "http://localhost:8888"; }
        if($db == null ){ $db = "localhost,root,root,reikodb";}

        if(file_exists('env.example'))
        {
            @copy('env.example' , '.env');
        }
        $cfg = file_get_contents('.env');
        $newconfig = $this->set('APP_BASEURL' , $baseurl,$cfg);
    
        file_put_contents('.env',$newconfig);
        
    }
}