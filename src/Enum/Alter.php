<?php

namespace EasySwoole\DDL\Enum;

/**
 * Alter操作选项
 * Class Alter
 * @package EasySwoole\DDL\Enum
 */
enum Alter
{
    case ADD;
    case MODIFY;
    case CHANGE;
    case DROP;
}
