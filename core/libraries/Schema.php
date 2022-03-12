<?php

namespace Reiko\Libraries;

class Schema
{


    public static function create($table_name, $data = [])
    {
        $sql = "CREATE TABLE {$table_name} (";
        $n = 1;
        foreach ($data as $col => $type) {
            if ($col == 'primary_key') continue;

            $e = explode("|", $type);

            /** column name and data length  */
            $sql .= "`$col` " . self::toSql($e[0], 'dataType');

            if (!in_array($e[0], ['timestamp', 'text'])) {
                $sql .= "(" . $e[1] . ")";
            } else {
                $sql .= self::toSql($e[1], 'extra');
            }

            /**
             * default value
             */
            if (isset($e[2])) {
                $sql .= self::toSql($e[2], 'extra') . " ";
            }
            /**
             * add extra
             */
            if (isset($e[3])) {
                $sql .= self::toSql($e[3], 'extra') . " ";
            }
            if ($n++ != count($data)) {
                $sql .= ",";
            }
        }
        $sql .= " PRIMARY KEY (`" . $data['primary_key'] . "`)";
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        return $sql;
    }
    public static function toSql($command, $method = '')
    {
        if ($method == 'dataType') {
            $tipe = ['string', 'int', 'bigint', 'text', 'date', 'timestamp'];
            $replace = [' VARCHAR', ' INT', ' BIGINT', ' TEXT', ' DATE', ' timestamp'];

            return str_replace($tipe, $replace, $command);
        } elseif ($method == 'extra') {

            $tipe = ['increment', 'not_null', 'null', 'on_create', 'on_update'];
            $replace = [' NOT NULL AUTO_INCREMENT', ' NOT NULL', ' NULL', ' NOT NULL DEFAULT current_timestamp()', ' NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()'];

            return str_replace($tipe, $replace, $command);
        }
    }

    public static function dropIfExists($table_name)
    {
        $sql = "DROP TABLE IF EXISTS {$table_name}";
        return $sql;
    }

    public static function drop($table_name)
    {
        $sql = "DROP TABLE {$table_name}";
        return $sql;
    }
}
