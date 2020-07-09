<?php

namespace EasySwoole\DDL;

use EasySwoole\DDL\Blueprint\Table;
use EasySwoole\DDL\Blueprint\Create\Table as CreateTable;
use EasySwoole\DDL\Blueprint\Alter\Table as AlterTable;

/**
 * 语句生成器
 * Class DDLBuilder
 * @package EasySwoole\DDL
 */
class DDLBuilder
{
    /**
     * 生成建表语句
     * @param string $table 表名称
     * @param callable $callable 在闭包中描述创建过程
     * @return string 返回生成的DDL语句
     */
    static function table($table, callable $callable)
    {
        $blueprint = new Table($table);
        $callable($blueprint);
        return $blueprint->__createDDL();
    }

    /**
     * 生成建表语句
     * @param string $table 表名称
     * @param callable $callable 在闭包中描述创建过程
     * @return string 返回生成的DDL语句
     */
    static function create($table, callable $callable)
    {
        $blueprint = new CreateTable($table);
        $callable($blueprint);
        return $blueprint->__createDDL();
    }

    /**
     * 生成更新表语句
     * @param string $table 表名称
     * @param callable $callable 在闭包中描述创建过程
     * @return string 返回生成的DDL语句
     */
    static function alter($table, callable $callable)
    {
        $blueprint = new AlterTable($table);
        $callable($blueprint);
        return $blueprint->__createDDL();
    }

    /**
     * 生成删除表语句
     * @param string $table 表名称
     * @param callable $callable 在闭包中描述创建过程
     * @return string 返回生成的DDL语句
     */
    static function drop($table, callable $callable)
    {
        $blueprint = new Table($table);
        $callable($blueprint);
        return $blueprint->__createDDL();
    }
}