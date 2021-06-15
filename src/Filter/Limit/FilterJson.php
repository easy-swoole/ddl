<?php

namespace EasySwoole\DDL\Filter\Limit;

use EasySwoole\DDL\Blueprint\AbstractInterface\ColumnInterface;
use EasySwoole\DDL\Contracts\FilterInterface;

/**
 * Class FilterJson
 * @package EasySwoole\DDL\Filter\Limit
 */
class FilterJson implements FilterInterface
{
    public static function run(ColumnInterface $column)
    {
        if ($column->getColumnLimit()) {
            throw new \InvalidArgumentException('col ' . $column->getColumnName() . ' type json no require fsp ');
        }
    }
}