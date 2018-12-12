<?php
/**
 * @desc 适配器模式MySQLi
 * User: hwbaker
 * Date: 2018/12/12
 * Time: 13:59
 */

namespace Imooc\Databasetest;

use Imooc\IDatabase;

class MySQLi implements IDatabase {

    protected $conn;
    function connect($host, $user, $password, $dbName)
    {
        // TODO: Implement connect() method.
//        $conn = mysql_connect("172.1.1.237", "dev_qyer", "QfON0hWKF9VSgFQcx",'jerp');
//        $conn = mysql_connect("127.0.0.1", "root", "12345678",'honey');
        $conn = mysqli_connect($host, $user, $password, $dbName);
        $this->conn = $conn;
    }

    function query($sql)
    {
        // TODO: Implement query() method.
        $res = mysqli_query($this->conn, $sql);
        return $res;
    }

    function fetchAll($res)
    {
        $res = mysqli_fetch_all($res);
        print_r($res);
        return $res;
    }

    function close()
    {
        // TODO: Implement close() method.
        mysqli_close($this->conn);
    }
}