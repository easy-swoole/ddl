<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/10/16
 * Time: 16:55
 */

namespace EasySwoole\DDL\Filter;


use EasySwoole\DDL\Blueprint\Column;
use EasySwoole\DDL\Contracts\FilterInterface;

class FilterYear implements FilterInterface
{
    public static function limit(Column $column)
    {
        if ($column->getColumnLimit()) {
            throw new \InvalidArgumentException('col ' . $column->getColumnName() . ' type year no require fsp ');
        }
    }

    public static function unsigned(Column $column)
    {
        if ($column->getUnsigned()) {
            throw new \InvalidArgumentException('col ' . $column->getColumnName() . ' type year no require unsigned ');
        }
    }

    public static function zerofill(Column $column)
    {
        if ($column->getZeroFill()) {
            throw new \InvalidArgumentException('col ' . $column->getColumnName() . ' type year no require zerofill ');
        }
    }
}