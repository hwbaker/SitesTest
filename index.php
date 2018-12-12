<?php

define('BASEDIR', __DIR__);

include BASEDIR.'/Imooc/Loder.php';
spl_autoload_register('\\Imooc\\Loder::autoload');

//require BASEDIR.'/Imooc/Object.php';
Imooc\Object::test();
App\Controller\Home\Index::test();

// 非工厂模式
//$db = new Imooc\DataBase();
$db = Imooc\DataBase::getInstance();
// 工厂模式调用
$db = Imooc\Factory::createDatabase();
//注册树模式
$db = Imooc\Register::get('db1');
//var_dump($db);

//$stack = new SplStack();
//$stack->push('data1');
//$stack->push('data2');
//echo $stack->pop();
//echo "<hr>";
//echo $stack->pop();

//$queue = new SplQueue();
//$queue->push(1);
//$queue->push(2);
//$queue->push(3);
//echo $queue->pop();
//$queue->enqueue('a');
//$queue->enqueue('b');
//echo $queue->dequeue();
//echo $queue->dequeue();
//print_r($queue);

//$minHeap = new SplMinHeap();

//策略模式
echo "<br><br><br>策略模式...<br>";
class page
{
    protected $strategy;

    function index()
    {
        $this->strategy->showAd();
        $this->strategy->showCate();
    }

    function setSetStrategy(Imooc\UserStrategy $strategy)
    {
        $this->strategy = $strategy;
    }
}
$page = new Page();
if (isset($_GET['female'])) {
    $strategy = new \Imooc\UserStrategyFemale();
} else {
    $strategy = new \Imooc\UserStrategyMale();
}
$page->setSetStrategy($strategy);
$page->index();


//观察者模式
echo "<br><br><br>观察者模式...<br>";
class Event extends \Imooc\EventGenerator
{
    function trigger()
    {
        echo "event<br>";
        $this->notify();
    }
}
class Observer1 implements \Imooc\Observer
{
    function update($event_info = null)
    {
        echo "{$event_info}.逻辑1<br>";
    }
}
class Observer2 implements \Imooc\Observer
{
    function update($event_info = null)
    {
        echo "逻辑2<br>";
    }
}
$event = new Event();
$ob1 = new Observer1();
$ob1->update('ob1');
$event->addObserver($ob1);
$event->addObserver(new Observer2());
//$event->trigger();
$event->notify();

// 适配器模式
//$db = new Imooc\Databasetest\DBPDO();
$db = new Imooc\Databasetest\MySQLi();
$db->connect("172.1.1.237", "dev_qyer", "QfON0hWKF9VSgFQcx", "honey");
$res = $db->query("select * from category");
$db->fetchAll($res);
$db->close();




