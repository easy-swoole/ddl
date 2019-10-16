<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/10/16
 * Time: 14:49
 */

namespace EasySwoole\DDL\Filter;


use EasySwoole\DDL\Blueprint\Column;
use EasySwoole\DDL\Contracts\FilterInterface;

class FilterDatetime implements FilterInterface
{
    public static function limit(Column $column)
    {
        if ($column->getColumnLimit() < 0 || $column->getColumnLimit() > 6) {
            throw new \InvalidArgumentException('col ' . $column->getColumnName() . ' type datetime(fsp), fsp must be range 0 to 6');
        }
    }

    public static function unsigned(Column $column)
    {
        if ($column->getUnsigned()) {
            throw new \InvalidArgumentException('col ' . $column->getColumnName() . ' type datetime no require unsigned ');
        }
    }

    public static function zerofill(Column $column)
    {
        if ($column->getZeroFill()) {
            throw new \InvalidArgumentException('col ' . $column->getColumnName() . ' type datetime no require zerofill ');
        }
    }
}