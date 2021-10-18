<?php
namespace Dev\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeDbfun extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'make:dbfun';
    protected static $defaultDescription = 'Automation command for make DB classes';
    protected function configure(): void
    {
       
        $this->addArgument('funName' , InputArgument::REQUIRED , "Name of db class");
        $this->addOption('methods' , null, InputOption::VALUE_OPTIONAL , 'Generate methods in db class');
        $this->addOption('table' ,null , InputOption::VALUE_OPTIONAL  , 'Use the table instead , default table is name of fundb');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
       $name = $input->getArgument('funName');
       $output->writeln("<comment>Generating $name please wait ... </comment>");
       $this->templateFun($name , $input->getOption('methods') , $input->getOption('table'));
       $output->write("<info>Successfully !</info>");
       return Command::SUCCESS;
    }
    protected function templateFun($filename,$methods,$table){

        if($table == null)
        {
            $table = strtolower($filename);
        }
$tmpl = "<?php
namespace Reiko;
/**
 * REIKO FRAMEWORK 
 *  
 * @package ReiKo Framework
 *
 * @author alinko <alinkokomansuby@gmail.com>
 * @author ReiYan <hariyantoriyan.hr@gmail.com>
 * @copyright (c) 2021 
 * 
 * @license MIT 
 * 
 */
use Reiko\Libraries\DB;
    
class ".ucfirst($filename)." extends DB
{
    protected \$table = \"{$table}\";
    protected \$id    = \"id_{$table}\";

    public function __construct()
    {
        parent::__construct();
        \$this->table(\$this->table);
    }

    /**
     * The reiko framework generated basic function for CRUD 
     *  @method create
     *  @method readAll
     *  @method readById
     *  @method update
     *  @method delete
     * 
     **/
    public function create(\$data = [])
    {
        return \$this->save(\$data);
    }

    public function readAll()
    {
        return \$this->select('*')->get();
    }

    public function delete(\$id)
    {
        return \$this->where([\$this->id => \$id])->delete();
    }

    public function readById(\$id)
    {
        return \$this->where([\$this->id => \$id])->fetchArray();
    }

    public function update(\$data= [] , \$id)
    {
        return \$this->set(\$data)->where([\$this->id => \$id])->update();
    }

    /** 
     *  You can add your method bellow
     */
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

file_put_contents( 'app/'.ucfirst($filename) . '.dbfun.php' , $tmpl);
    }
}