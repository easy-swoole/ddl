<?php

namespace EasySwoole\DDL\Enum;

/**
 * 外键删除、更新操作类型枚举
 * Class Foreign
 * @package EasySwoole\DDL\Enum
 */
enum Foreign :string
{
    case CASCADE = 'CASCADE';
    case NO_ACTION = 'NO ACTION';
    case RESTRICT = 'RESTRICT';
    case SET_NULL = 'SET NULL';
}
