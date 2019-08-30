<?php


namespace EasySwoole\DDL\Enum;


use EasySwoole\Spl\SplEnum;

class DataType extends SplEnum
{
    // 整型
    const INT = 'int';
    const BIGINT = 'bigint';
    const TINYINT = 'tinyint';
    const SMALLINT = 'smallint';
    const MEDIUMINT = 'mediumint';

    // 小数
    const FLOAT = 'float';
    const DOUBLE = 'double';
    const DECIMAL = 'decimal';

    // 时间
    const DATE = 'date';
    const TIME = 'time';
    const YEAR = 'year';
    const DATETIME = 'datetime';
    const TIMESTAMP = 'timestamp';

    // 字符
    const CHAR = 'char';
    const TEXT = 'text';
    const VARCHAR = 'varchar';
    const TINYTEXT = 'tinytext';
    const MEDIUMTEXT = 'mediumtext';
    const LONGTEXT = 'longtext';

    // 二进制大对象
    const BLOB = 'blob';
    const TINYBLOB = 'tinyblob';
    const MEDIUMBLOB = 'mediumblob';
    const LONGBLOB = 'longblob';
}