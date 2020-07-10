<?php

namespace EasySwoole\DDL\Blueprint;

/**
 * 创建表结构描述
 * 暂只支持创建表 CREATE 结构
 * Class Table
 * @package EasySwoole\Mysqli\DDLBuilder\Blueprints
 */
class Table extends \EasySwoole\DDL\Blueprint\Create\Table
{
    function colInt(string $name, int $limit = null)
    {
        return $this->int($name, $limit);
    }

    function colBigInt(string $name, int $limit = null)
    {
        return $this->bigint($name, $limit);
    }

    function colTinyInt(string $name, int $limit = null)
    {
        return $this->tinyint($name, $limit);
    }

    function colSmallInt(string $name, int $limit = null)
    {
        return $this->smallint($name, $limit);
    }

    function colMediumInt(string $name, int $limit = null)
    {
        return $this->mediumInt($name, $limit);
    }

    function colFloat(string $name, int $precision = null, int $digits = null)
    {
        return $this->float($name, $precision, $digits);
    }

    function colDouble(string $name, int $precision = null, int $digits = null)
    {
        return $this->double($name, $precision, $digits);
    }

    function colDecimal(string $name, int $precision = 10, int $digits = 0)
    {
        return $this->decimal($name, $precision, $digits);
    }

    function colDate(string $name)
    {
        return $this->date($name);
    }

    function colYear(string $name)
    {
        return $this->year($name);
    }

    function colTime(string $name, ?int $fsp = null)
    {
        return $this->time($name, $fsp);
    }

    function colDateTime(string $name, ?int $fsp = null)
    {
        return $this->datetime($name, $fsp);
    }

    function colTimestamp(string $name, ?int $fsp = null)
    {
        return $this->timestamp($name, $fsp);
    }

    function colChar(string $name, ?int $limit = null)
    {
        return $this->char($name, $limit);
    }

    function colVarChar(string $name, ?int $limit = null)
    {
        return $this->varchar($name, $limit);
    }

    function colText(string $name)
    {
        return $this->text($name);
    }

    function colTinyText(string $name)
    {
        return $this->tinytext($name);
    }

    function colLongText(string $name)
    {
        return $this->longtext($name);
    }

    function colMediumText(string $name)
    {
        return $this->mediumtext($name);
    }

    function colBlob(string $name)
    {
        return $this->blob($name);
    }

    function colLongBlob(string $name)
    {
        return $this->longblob($name);
    }

    function colTinyBlob(string $name)
    {
        return $this->tinyblob($name);
    }

    function colMediumBlob(string $name)
    {
        return $this->mediumblob($name);
    }

    function indexNormal(string $name, $columns)
    {
        return $this->normal($name, $columns);
    }

    function indexUnique(string $name, $columns)
    {
        return $this->unique($name, $columns);
    }

    function indexPrimary(string $name, $columns)
    {
        return $this->primary($name, $columns);
    }

    function indexFullText(string $name, $columns)
    {
        return $this->fulltext($name, $columns);
    }
}