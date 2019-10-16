<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/10/16
 * Time: 14:48
 */

namespace EasySwoole\DDL\Filter;


use EasySwoole\DDL\Blueprint\Column;
use EasySwoole\DDL\Contracts\FilterInterface;

class FilterDecimal implements FilterInterface
{
    public static function limit(Column $column)
    {
        if (!is_array($column->getColumnLimit())) {
            throw new \InvalidArgumentException('col ' . $column->getColumnName() . ' type decimal(M,D), params is error');
        }
        list($precision, $digits) = $column->getColumnLimit();
        if (is_numeric($precision) && is_numeric($digits) && ($digits > $precision)) {
            throw new \InvalidArgumentException('col ' . $column->getColumnName() . ' type decimal(M,D), M must be >= D');
        }
    }

    public static function unsigned(Column $column)
    {

    }

    public static function zerofill(Column $column)
    {

    }
}