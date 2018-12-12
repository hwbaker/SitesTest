<?php
/**
 * @desc 适配器模式MySQL===>php7不支持
 * User: hwbaker
 * Date: 2018/12/12
 * Time: 13:58
 */

namespace Imooc\Databasetest;

use Imooc\IDatabase;

class MySQL implements IDatabase {

    protected $conn;

    function connect($host, $user, $password, $dbName)
    {
        // TODO: Implement connect() method.
//        $conn = mysql_connect("172.1.1.237", "dev_qyer", "QfON0hWKF9VSgFQcx",true);
//        $conn = mysql_connect("127.0.0.1", "root", "12345678",true);
        $conn = mysql_connect($host, $user, $password);
//        mysql_select_db($dbName, $conn);
        $this->conn = $conn;
    }

    function query($sql)
    {
        // TODO: Implement query() method.
        $res = mysql_query($sql, $this->conn);
        return $res;
    }

    function close()
    {
        // TODO: Implement close() method.
        mysql_close($this->conn);
    }

}