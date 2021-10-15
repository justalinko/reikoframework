<?php
namespace Dev\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeHandler extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'make:handler';
    protected static $defaultDescription = 'Automation command for make handlers and method';
    protected function configure(): void
    {
       
        $this->addArgument('HandlerName' , InputArgument::REQUIRED , "Name of handler");
        $this->addOption('methods' , null, InputOption::VALUE_OPTIONAL , 'Generate methods in handlers');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
       $name = $input->getArgument('HandlerName');
       $output->writeln("<comment>Generating $name please wait ... </comment>");
       $this->templateHandler($name , $input->getOption('methods'));
       $output->write("<info>Successfully !</info>");
       return Command::SUCCESS;
    }
    protected function templateHandler($filename,$methods){

$tmpl = "<?php
namespace Reiko\App;
/**
 * REIKO FRAMEWORK 
 *  
 * @package ReiKo Framework
 *
 * @author alinko <alinkokomansuby@gmail.com>
 * @author ReiYan <hariyantoriyan.hr@gmail>
 * @copyright (c) 2021 
 * 
 * @license MIT 
 * 
 */
use Reiko\Libraries\Handler;
    
class ".ucfirst($filename)." extends Handler{
    
    public function index()
    {
        // some code here.
    }
    ";
if($methods != null)
{
    foreach(explode("," , $methods) as $method){
$tmpl.= "
    public function $method()
    {
        // some code here for method : $method
    }
";
    }
}
$tmpl.= "
}";

file_put_contents( 'app/handler/'.ucfirst($filename) . 'Handler.php' , $tmpl);
    }
}