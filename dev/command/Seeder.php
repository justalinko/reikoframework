<?php

namespace Dev\Command;



use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Seeder extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'db:seed';
    protected static $defaultDescription = 'Seed database with generate random data';
    protected function configure(): void
    {
        $this->addArgument('dbfunName', InputArgument::REQUIRED, "Class DBfun Name");
        $this->addOption('method', null, InputOption::VALUE_OPTIONAL, "Method UP or DOWN");
        $this->addOption('max', null, InputOption::VALUE_OPTIONAL, "Maximum generate random data");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(ROOT_PATH);
        $dotenv->load();

        $method = ($input->getOption('method') == null) ? 'up' : $input->getOption('method');
        $max = ($input->getOption('max') == null) ? 10 : $input->getOption('max');
        $dbpath = dirname(dirname(__DIR__)) . '/app/' . $input->getArgument('dbfunName') . '.dbfun.php';
        if (file_exists($dbpath)) {
            require dirname(dirname(__DIR__)) . '/core/libraries/DB.php';
            require $dbpath;
        } else {
            $output->writeln('<comment>Class ' . $input->getArgument('dbfunName') . ' Not exist !</comment>');
            exit;
        }
        $this->calldb('\Reiko\\' . $input->getArgument('dbfunName'))->seeder($method, $max);
        return Command::SUCCESS;
    }
    protected function calldb($name)
    {
        return (new $name);
    }
}
