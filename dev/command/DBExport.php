<?php

namespace Dev\Command;



use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DBExport extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'db:export';
    protected static $defaultDescription = 'Dump all sql databases';
    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(ROOT_PATH);
        $dotenv->load();
        require dirname(dirname(__DIR__)) . '/core/libraries/DB.php';

        $file = $this->calldb('\Reiko\\Libraries\\DB')->export();
        $output->writeln('<info>Successfully export database : </info><comment>' . $file . ' Saved.</comment>');
        return Command::SUCCESS;
    }
    protected function calldb($name)
    {
        return (new $name);
    }
}
