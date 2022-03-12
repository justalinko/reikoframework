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

        $this->addArgument('funName', InputArgument::REQUIRED, "Name of db class");
        $this->addOption('methods', null, InputOption::VALUE_OPTIONAL, 'Generate methods in db class');
        $this->addOption('table', null, InputOption::VALUE_OPTIONAL, 'Use the table instead , default table is name of fundb');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('funName');
        $output->writeln("<comment>Generating $name please wait ... </comment>");
        $this->templateFun($name, $input->getOption('methods'), $input->getOption('table'));
        $output->write("<info>Successfully !</info>");
        return Command::SUCCESS;
    }
    protected function templateFun($filename, $methods, $table)
    {

        if ($table == null) {
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
use Reiko\Libraries\Schema;
use Faker;

class " . ucfirst($filename) . " extends DB
{
    protected \$table = \"{$table}\";
    protected \$id    = \"id_{$table}\";

    public function __construct()
    {
        parent::__construct();
        \$this->table(\$this->table);
    }


    /**
     * migration method
     *
     * @param  string \$method ( up , down , restart )
     * @return void
     */
    public function migration(\$method = 'up')
    {
        \$schema = Schema::create(
            \$this->table,
            [
                'primary_key' => 'id',
                'id' => 'int|11|increment',
                'created_at' => 'timestamp|on_create',
                'updated_at' => 'timestamp|on_update'
            ]
        );

        if (\$method == 'up') {
            echo \"[!] Running migration up ... \\n\";
            if (\$this->exec(\$schema)) {
                echo \"[+] Created table successfully \\n\";
            } else {
                echo \"[-] Create table failed \\n\";
            }
        } elseif (\$method == 'down') {
            echo \"[!] Running migration down ... \\n\";
            if (\$this->exec(Schema::dropIfExists(\$this->table))) {
                echo \"[+] Delete table successfully \\n\";
            } else {
                echo \"[-] Delete table failed \\n\";
            }
        } elseif (\$method == 'restart') {
            echo \"[!] Running migration down ... \\n\";
            if (\$this->exec(Schema::dropIfExists(\$this->table))) {
                echo \"[+] Delete table successfully \\n\";
            } else {
                echo \"[-] Delete table failed \\n\";
            }

            echo \"[!] Running migration up ... \\n\";
            if (\$this->exec(\$schema)) {
                echo \"[+] Created table successfully \\n\";
            } else {
                echo \"[-] Create table failed \\n\";
            }
           
        }
    }

    /**
     * MAKE A SEEDER HERE
     *
     * @param  string  \$method
     * @param  integer \$total
     * @return void
     */
    public function seeder(\$method = 'up', \$total = 10)
    {
        \$faker = Faker\Factory::create();
        
        if (\$method == 'up') {
            for (\$i = 1; \$i <= \$total; \$i++) {
                \$this->create(
                    ['column' => 'value']
                );
                echo \"[\$i] DATA INSERTED SUCCESSFULLY \\n\";
            }
        } else {
            \$this->truncate();
            echo \"[{\$this->table}] TABLE TRUNCATED SUCCESSFULLY \\n\";
        }
    }
    /**
     * The reiko framework generated basic function for CRUD 
     *  @method create
     *  @method readAll
     *  @method readById
     *  @method change
     *  @method remove
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

    public function remove(\$id)
    {
        return \$this->where([\$this->id => \$id])->delete();
    }

    public function readById(\$id)
    {
        return \$this->find([\$this->id => \$id]);
    }

    public function change(\$data= [] , \$id)
    {
        return \$this->set(\$data)->where([\$this->id => \$id])->update();
    }

    /** 
     *  You can add your method bellow
     */
    ";
        if ($methods != null) {
            foreach (explode(",", $methods) as $method) {
                $tmpl .= "
    public function $method()
    {
        // some code here for method : $method
    }
";
            }
        }
        $tmpl .= "
}";

        file_put_contents('app/' . ucfirst($filename) . '.dbfun.php', $tmpl);
    }
}
