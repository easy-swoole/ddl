<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/10/16
 * Time: 11:55
 */

namespace EasySwoole\DDL;


use EasySwoole\DDL\Blueprint\Column;

class Filter
{

    public static function checkTypeLimit(Column $column)
    {
        call_user_func(['EasySwoole\\DDL\\Filter\\Filter' . ucfirst($column->getColumnType()), 'limit'], $column);
    }

    public static function checkUnsigned(Column $column)
    {
        call_user_func(['EasySwoole\\DDL\\Filter\\Filter' . ucfirst($column->getColumnType()), 'unsigned'], $column);
    }

    public static function checkZerofill(Column $column)
    {
        call_user_func(['EasySwoole\\DDL\\Filter\\Filter' . ucfirst($column->getColumnType()), 'zerofill'], $column);
    }
}