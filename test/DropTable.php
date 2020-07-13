<?php

namespace EasySwoole\DDL\Test;

require_once '../vendor/autoload.php';

use EasySwoole\DDL\DDLBuilder;

$stuSql = DDLBuilder::drop('student');
echo $stuSql . PHP_EOL;

$stuSql = DDLBuilder::dropIfExists('student');
echo $stuSql . PHP_EOL;

//以下是输出sql语句
/*

DROP TABLE `student`;

DROP TABLE IF EXISTS `student`;

 */

