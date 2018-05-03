<?php
//namespace struct;
include "MyStack.php";

define('BINARY', 2);
define('OCTAL', 8);
define('HEXADEMICAL', 16);


/**
 * 栈应用-实现进制转换.
 * 1348（十进制）= 2504（八进制）= 544（十六进制）= 10101000100（二进制）
 * @param int $num
 * @param int $hex
 */
function hexConversion($num = 0, $hex = 2)
{
    switch ($hex)
    {
        case 2:
            $hex = BINARY;
            break;
        case 8:
            $hex = OCTAL;
            break;
        case 16:
            $hex = HEXADEMICAL;
            break;
        default:
            $hex = BINARY;
            break;
    }

    $transArr = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'A', 'B', 'C', 'D', 'E', 'F');
    $stack = new MyStack(20);
    while (0 != $num) {
        $mod = $num % $hex;
        $mod = isset($transArr[$mod]) ? $transArr[$mod] : $mod;
        $stack->push($mod);

        $num = floor($num / $hex);
    }
    $stack->stackTraverse();

//    $pop = '';
//    while (!$stack->stackEmpty()) {
//        $stack->pop($pop);
//        echo $transArr[$pop] . ' ';
//    }
}

$num = 2016;
hexConversion($num, 8);


/**
 * 栈应用-括号匹配
 * [()]
 * [()()]
 * [()[()]]
 * [[()]
 * [()]]
 * @param string $str
 */
function strMatch($str = '')
{
    $stack = new MyStack(30);
    $mStack = new MyStack(30); //需匹配字符串入栈
    $needStr = 0;

    for ($i = 0; $i < strlen($str); $i++) {
        echo "\r\n\r\ni:" . $i ."\r\n";
        if ($str[$i] !== $needStr) {
            $stack->push($str[$i]);
            switch ($str[$i])
            {
                case '[':
                    if (0 !== $needStr) {
                        $mStack->push($needStr);
                    }
                    $needStr = ']';
                    break;
                case '(':
                    if (0 !== $needStr) {
                        $mStack->push($needStr);
                    }
                    $needStr = ')';
                    break;
                default:
                    echo "字符串不匹配default...\r\n";
                    break;
            }
        } else {
            $ele = '';
            $stack->pop($ele);
            if (!$mStack->pop($needStr)) {
                echo "!mStack->pop...\r\n";
                $needStr = 0;
            }
        }
        echo 'stack:';
        $stack->stackTraverse();

        echo 'mStack:';
        $mStack->stackTraverse();

        echo 'needStr:' . $needStr . "\r\n";
    }

    if ($stack->stackEmpty()) {
        echo "字符串匹配...\r\n";
    } else {
        echo "字符串不匹配...\r\n";
    }
}

$str = '[()]]';
strMatch($str);


$splStack = new SplStack();