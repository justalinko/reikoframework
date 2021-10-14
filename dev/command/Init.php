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
    protected static $defaultDescription = 'Run local php-server development mode';
    protected function configure(): void
    {
       
        $this->addOption('at' , null, InputOption::VALUE_OPTIONAL , 'Default server is http://localhost:8888 you can change address with options --at');
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
       if($input->getOption('at') == null)
       {
           @system('php -S localhost:8888 -t public/');
           Command::SUCCESS;
       }else{
            @system('php -S '.$input->getOption('at').' -t public/');
           Command::SUCCESS;

       }
    }
}