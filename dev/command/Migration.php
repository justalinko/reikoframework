<?php

namespace Dev\Command;



use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Migration extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'db:migration';
    protected static $defaultDescription = 'Migrate database tables';
    protected function configure(): void
    {
        $this->addArgument('dbfunName', InputArgument::REQUIRED, "DBFun Class Name");
        $this->addArgument('method', InputArgument::REQUIRED, "Migration method up or down or restart");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(ROOT_PATH);
        $dotenv->load();

        $method = ($input->getArgument('method') == null) ? 'up' : $input->getArgument('method');

        $dbpath = dirname(dirname(__DIR__)) . '/app/' . $input->getArgument('dbfunName') . '.dbfun.php';
        if (file_exists($dbpath)) {
            require dirname(dirname(__DIR__)) . '/core/libraries/Schema.php';

            require dirname(dirname(__DIR__)) . '/core/libraries/DB.php';
            require $dbpath;
        } else {
            $output->writeln('<comment>Class ' . $input->getArgument('dbfunName') . ' Not exist !</comment>');
            exit;
        }
        $this->calldb('\Reiko\\' . $input->getArgument('dbfunName'))->migration($method);
        return Command::SUCCESS;
    }
    protected function calldb($name)
    {
        return (new $name);
    }
}
