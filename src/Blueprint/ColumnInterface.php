<?php

namespace EasySwoole\DDL\Blueprint;

/**
 * 字段构造器
 * Class Column
 * @package EasySwoole\DDL\Blueprint
 */
interface ColumnInterface
{

    /**
     * 设置字段名称
     * @param string $name 字段名称
     * @return ColumnInterface
     */
    function setColumnName(string $name);

    /**
     * 设置字段类型
     * @param string $type
     * @return ColumnInterface
     */
    function setColumnType(string $type);

    /**
     * @return mixed
     */
    function getColumnLimit();

    /**
     * @return mixed
     */
    function getUnsigned();

    /**
     * @return mixed
     */
    function getZeroFill();
}
