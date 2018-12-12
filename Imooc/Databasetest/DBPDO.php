<?php
/**
 * @desc 适配器模式PDO
 * User: hwbaker
 * Date: 2018/12/12
 * Time: 13:59
 */

namespace Imooc\Databasetest;

use Imooc\IDatabase;
use PDO;
use PDOException;
use Exception;

class DBPDO implements IDatabase {

    private $db;
    private $query;
    private static $_instance = null;

    function connect($host, $user, $password, $dbName)
    {
        // TODO: Implement connect() method.
        try {
            $db = new PDO("mysql:host={$host};port=3306;dbname={$dbName};charset=utf8", $user, $password,
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                )
            );

//            $list = $db->query("select * from category")->fetchAll();
//            foreach ($list as $val) {
//                print_r($val);
//            }

            $this->db = $db;
        } catch(\PDOException $pe) {
            echo $pe->getMessage();
        }

    }

    /**
     * @return DBPDO|null
     * @throws Exception
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance) || !self::$_instance instanceof self) {
            try {
                self::$_instance = new self();
            } catch (PDOException $pe) {
                // 这里应该抛一个自定义异常以便上层处理
                throw new Exception('Could not connect to database:');
            }
        }

        return self::$_instance;
    }

    public function query($sql)
    {
        $query = $this->db->query($sql);
        return $query;
    }

    function fetchAll($que)
    {
        $res = $que->fetchAll(PDO::FETCH_ASSOC);
        print_r($res);
        return $res;
    }

    public function update($sql)
    {
        return $this->db->exec($sql);
    }

    function close()
    {
        // TODO: Implement close() method.
        unset($this->db);
    }

}