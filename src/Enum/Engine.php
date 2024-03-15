<?php

namespace EasySwoole\DDL\Enum;

/**
 * 储存引擎类型枚举
 * Class Engine
 * @package EasySwoole\DDL\Enum
 */
enum Engine :string
{
    case CSV = 'csv';
    case INNODB = 'innodb';
    case MEMORY = 'memory';
    case MYISAM = 'myisam';
    case ARCHIVE = 'archive';
    case FEDERATED = 'federated';
    case BLACKHOLE = 'blackhole';
    case MRG_MYISAM = 'mrg_myisam';
    case PERFORMANCE_SCHEMA = 'performance_schema';

    public static function isValidValue($val)
    {
        return $val instanceof Engine;
    }
}
