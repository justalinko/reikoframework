<?php

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

namespace Reiko\Libraries;


class DB
{

    protected $connection;
    protected $query;
    protected $show_errors = TRUE;
    protected $query_closed = TRUE;
    public $query_count = 0;
    private $table;
    private $sql;
    protected $updateQueries;
    protected $deleteQueries;

    /**
     * @method __construct
     * 
     * Connection to database
     */
    public function __construct()
    {
        $dbhost = $_ENV['DB_HOSTNAME'];
        $dbuser = $_ENV['DB_USERNAME'];
        $dbpass = $_ENV['DB_PASSWORD'];
        $dbname = $_ENV['DB_DATABASE'];

        $this->connection = new \mysqli($dbhost, $dbuser, $dbpass, $dbname);
        if ($this->connection->connect_error) {
            $this->error('Failed to connect to MySQL - ' . $this->connection->connect_error);
        }
        $this->connection->set_charset('utf8');
    }

    /**
     * 
     * @method query
     * 
     * Based query for all builder.
     */
    public function query($query)
    {
        if (!$this->query_closed) {
            $this->query->close();
        }
        if ($this->query = $this->connection->prepare($query)) {
            if (func_num_args() > 1) {
                $x = func_get_args();
                $args = array_slice($x, 1);
                $types = '';
                $args_ref = array();
                foreach ($args as $k => &$arg) {
                    if (is_array($args[$k])) {
                        foreach ($args[$k] as $j => &$a) {
                            $types .= $this->_gettype($args[$k][$j]);
                            $args_ref[] = &$a;
                        }
                    } else {
                        $types .= $this->_gettype($args[$k]);
                        $args_ref[] = &$arg;
                    }
                }
                array_unshift($args_ref, $types);
                call_user_func_array(array($this->query, 'bind_param'), $args_ref);
            }
            $this->query->execute();
            if ($this->query->errno) {
                $this->error('Unable to process MySQL query (check your params) - ' . $this->query->error);
            }
            $this->query_closed = FALSE;
            $this->query_count++;
        } else {
            $this->error('Unable to prepare MySQL statement (check your syntax) - ' . $this->sql);
        }
        return $this;
    }

    public function select($selected)
    {
        $this->sql = "SELECT {$selected} FROM {$this->table}";

        return $this;
    }
    public function where($condition = [])
    {
        $c = count($condition);
        if ($c > 0) {
            $this->sql .= " WHERE ";
            $n = 1;
            foreach ($condition as $key => $val) {

                $this->sql .= " {$key}=\"{$val}\" ";
                if ($n++ != $c) {
                    $this->sql .= " AND ";
                }
                $this->sql .= "";
            }
        } else {

            $this->error("Unable process your Query using `where` : " . $this->sql);
        }

        return $this;
    }
    /**
     * 
     * @method table
     * @var $this->table
     * 
     * set table to 
     */
    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * 
     * @method get
     * @return Array
     * 
     * FetchAll querys
     */
    public function get()
    {
        return $this->query($this->sql)->fetchAll();
    }

    /**
     * @method getWhere
     * @return array
     */

    public function getWhere($condition = [])
    {
        return $this->select('*')->where($condition)->get();
    }

    /**
     * @method find
     * @param array
     * 
     * fetch all querys where 
     */
    public function find($id = [])
    {
        $sql = "SELECT * FROM {$this->table}  ";
        $c = count($id);

        if ($c > 0) {
            $sql .= " WHERE ";
            $n = 1;
            foreach ($id as $key => $val) {
                $sql .= " {$key}=\"{$val}\" ";
                if ($n++ != $c) {
                    $sql .= " AND ";
                }
                $sql .= "";
            }
        }
        $query = $this->query($sql);

        return $query->fetchArray();
    }

    /**
     * 
     * @method findAll
     * @param array or null
     * 
     * find all tables content
     */
    public function findAll($id = [])
    {
        $sql = "SELECT * FROM {$this->table} ";
        $c = count($id);

        if ($c > 0) {
            $sql .= " WHERE ";
            $n = 1;
            foreach ($id as $key => $val) {
                $sql .= " {$key}='{$val}' ";
                if ($n++ != $c) {
                    $sql .= " AND ";
                }
                $sql .= "";
            }
        }
        $query = $this->query($sql);

        return $query->fetchAll();
    }

    /**
     * 
     * @method fetchALl
     * @return array
     */

    public function fetchAll($callback = null)
    {
        $params = array();
        $row = array();
        $meta = $this->query->result_metadata();
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }
        call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            $r = array();
            foreach ($row as $key => $val) {
                $r[$key] = $val;
            }
            if ($callback != null && is_callable($callback)) {
                $value = call_user_func($callback, $r);
                if ($value == 'break') break;
            } else {
                $result[] = $r;
            }
        }
        $this->query->close();
        $this->query_closed = TRUE;
        return $result;
    }

    /**
     * 
     * @method fetchArray
     * 
     * @return array
     */
    public function fetchArray()
    {
        $params = array();
        $row = array();
        $meta = $this->query->result_metadata();
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }
        call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            foreach ($row as $key => $val) {
                $result[$key] = $val;
            }
        }
        $this->query->close();
        $this->query_closed = TRUE;
        return $result;
    }


    /** insert or update data */
    /**
     * @method update
     * 
     * Use :
     * 
     *  $db->table('users')->set(['username' => 'admin'])->where(['id' => 1])->update();
     * 
     *  $db->set(['username' => 'admin')->where(['id' => 1])->update('users');
     */
    public function update($table = null)
    {
        if ($table != null) {
            $this->table($table);
        }

        $this->updateQueries = "UPDATE {$this->table} ";
        $this->updateQueries .= $this->sql;
        return $this->query($this->updateQueries);
    }
    public function set($arr = [])
    {
        $c = count($arr);
        $this->setUpdate = "";
        //   $this->sql = $this->sql;
        if ($c > 0) {
            $this->sql .= " SET ";
            $n = 1;
            foreach ($arr as $key => $val) {
                $this->sql .= " {$key}='{$val}' ";
                if ($n++ != $c) {
                    $this->sql .= " , ";
                }
                $this->sql .= "";
            }
        }

        return $this;
    }

    /**
     * @method save
     * 
     * Use
     *  $db->table('users')->save(['username' => 'admin' , 'password' => '123456']);
     * $db->save(['username' => 'admin' , 'password' => '123456'] , 'users');
     */

    public function save($data = [], $table = null)
    {
        if ($table != null) {
            $this->table($table);
        }

        $this->sql = "INSERT INTO `{$this->table}` ";
        $c = count($data);

        if ($c > 0) {

            $n = 1;
            $this->sql .= "(";
            foreach ($data as $key => $val) {
                $this->sql .= "`{$key}`";
                if ($n++ != $c) {
                    $this->sql .= ", ";
                }
                $this->sql .= "";
            }
            $this->sql .= ")  ";
            $this->sql .= " VALUES(";
            $n2 = 1;
            foreach ($data as $key => $val) {
                $this->sql .= "'{$val}'";
                if ($n2++ != $c) {
                    $this->sql .= ",";
                }
                $this->sql .= "";
            }
            $this->sql .= ") ";
        }

        return $this->query($this->sql);
    }
    /**
     * @method insert alias of save
     */
    public function insert($data = [], $table = null)
    {
        return $this->save($data, $table);
    }


    /** delete */
    /**
     * @method delete
     * 
     * Use
     * 
     * $db->delete('users' , ['id' => 1] );
     * $db->where(['id' => 1])->delete('users');
     * $db->table('users)->where(['id' => 1])->delete();
     * 
     */
    public function delete($table = null, $id = [])
    {
        if ($table != null) {
            $this->table($table);
        }
        $this->deleteQueries = "DELETE FROM {$this->table} ";
        if (count($id) > 0) {
            $this->deleteQueries .= " WHERE ";
            foreach ($id as $key => $val) {
                $this->deleteQueries .= " {$key}='{$val}' ";
                if ($n++ != $c) {
                    $this->deleteQueries .= " AND ";
                }
                $this->deleteQueries .= "";
            }
        } else {
            $this->deleteQueries .= $this->sql;
        }

        echo $this->deleteQueries;
    }

    public function close()
    {
        return $this->connection->close();
    }

    public function numRows()
    {
        $this->query->store_result();
        return $this->query->num_rows;
    }

    public function affectedRows()
    {
        return $this->query->affected_rows;
    }

    public function lastInsertID()
    {
        return $this->connection->insert_id;
    }

    public function error($error)
    {
        if ($this->show_errors) {
            exit($error);
        }
    }

    private function _gettype($var)
    {
        if (is_string($var)) return 's';
        if (is_float($var)) return 'd';
        if (is_int($var)) return 'i';
        return 'b';
    }

     /**
     * Get the number of records in the result set
     * @return int
     */
    /**
     * @method count
     * 
     * Used to get the number of records in the result set
     * 
     * example:
     * 
     */
    public function count() {
        return count($this->query($this->sql)->fetchAll());
    }
}
