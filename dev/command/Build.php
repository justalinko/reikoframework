<?php

namespace Dev\Command;

use Alchemy\Zippy\Zippy;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;

class Build extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:build';
    protected static $defaultDescription = 'Build your application to production';
    protected function configure(): void
    {

        $this->addArgument('appname', InputArgument::REQUIRED, "Name of Application");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<comment>Running `clear:cache` </comment>');
        $cmd = $this->getApplication()->find('clear:cache');
        $arg = [];
        $arr = new ArrayInput($arg);
        $cmd->run($arr, $output);
        $filename = $input->getArgument('appname') . '.zip';
        $output->writeln('<comment>Running `composer update --no-dev` </comment>');
        @system('composer update --no-dev');

        $output->writeln("<comment>Generate htaccess.txt and index.php files ...</comment>");
        copy(dirname(__DIR__) . '/src/index.php', dirname(dirname(__DIR__)) . '/index.php');
        copy(dirname(__DIR__) . '/src/htaccess.txt', dirname(dirname(__DIR__)) . '/htaccess.txt');

        $output->write('<info>Successfully build application : ' . $filename . ' </info>');
        $this->createZip($filename);
        return Command::SUCCESS;
    }
    protected function createZip($file)
    {
        $zip = Zippy::load();
        $base = dirname(dirname(__DIR__)) . '/';
        $archive = $zip->create($file, [
            $base . 'app',
            $base . 'public',
            $base . 'vendor',
            $base . 'index.php',
            $base . 'htaccess.txt',
            $base . '.env'
        ], true);
    }
}
