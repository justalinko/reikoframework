<?php
namespace Dev\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ClearCache extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'clear:cache';
    protected static $defaultDescription = 'Clear cache view files';
    protected function configure(): void
    {
       
       
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

       $output->writeln("<comment>Clear cache please wait ... </comment> \n\n");
       $cache = 'app/cache/';
       foreach(scandir($cache) as $file)
       {
           if(is_file($cache.$file))
           {
               @unlink($cache.$file);
               $output->write("<comment>CLEAR : $file </comment><info> OK </info> \n");
           }
       }
       $output->write("<info>Successfully !</info>");
       return Command::SUCCESS;
    }
}