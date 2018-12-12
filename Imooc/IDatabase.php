<?php

namespace Imooc;

interface IDatabase
{
    function connect($host, $user, $password, $dbName);
    function query($sql);
    function close();
}