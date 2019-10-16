<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/10/16
 * Time: 14:50
 */

namespace EasySwoole\DDL\Filter;


use EasySwoole\DDL\Blueprint\Column;
use EasySwoole\DDL\Contracts\FilterInterface;

class FilterChar implements FilterInterface
{
    public static function limit(Column $column)
    {
        if ($column->getColumnLimit() < 0 || $column->getColumnLimit() > 255) {
            throw new \InvalidArgumentException('col ' . $column->getColumnName() . ' type char(limit), limit must be range 1 to 255');
        }
    }

    public static function unsigned(Column $column)
    {
        if ($column->getUnsigned()) {
            throw new \InvalidArgumentException('col ' . $column->getColumnName() . ' type blob no require unsigned ');
        }
    }

    public static function zerofill(Column $column)
    {
        if ($column->getZeroFill()) {
            throw new \InvalidArgumentException('col ' . $column->getColumnName() . ' type char no require zerofill ');
        }
    }

}