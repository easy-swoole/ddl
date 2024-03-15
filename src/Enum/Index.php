<?php

namespace EasySwoole\DDL\Enum;

use EasySwoole\Spl\SplEnum;

/**
 * 索引类型枚举
 * Class Index
 * @package EasySwoole\DDL\Enum
 */
enum Index: string
{
    case NORMAL = 'normal';
    case UNIQUE = 'unique';
    case PRIMARY = 'primary';
    case FULLTEXT = 'fulltext';

    public static function isValidValue($val)
    {
        return $val instanceof Index;
    }
}
