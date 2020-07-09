<?php

namespace EasySwoole\DDL\Blueprint;

use EasySwoole\DDL\Blueprint\Create\Column;
use EasySwoole\DDL\Blueprint\Create\Index;

/**
 * @method Column colInt(string $name, int $limit = null)
 * @method Column colBigInt(string $name, int $limit = null)
 * @method Column colTinyInt(string $name, int $limit = null)
 * @method Column colSmallInt(string $name, int $limit = null)
 * @method Column colMediumInt(string $name, int $limit = null)
 * @method Column colFloat(string $name, int $precision = null, int $digits = null)
 * @method Column colDouble(string $name, int $precision = null, int $digits = null)
 * @method Column colDecimal(string $name, int $precision = 10, int $digits = 0)
 * @method Column colDate(string $name)
 * @method Column colYear(string $name)
 * @method Column colTime(string $name, ?int $fsp = null)
 * @method Column colDateTime(string $name, ?int $fsp = null)
 * @method Column colTimestamp(string $name, ?int $fsp = null)
 * @method Column colChar(string $name, ?int $limit = null)
 * @method Column colVarChar(string $name, ?int $limit = null)
 * @method Column colText(string $name)
 * @method Column colTinyText(string $name)
 * @method Column colLongText(string $name)
 * @method Column colMediumText(string $name)
 * @method Column colBlob(string $name)
 * @method Column colLongBlob(string $name)
 * @method Column colTinyBlob(string $name)
 * @method Column colMediumBlob(string $name)
 * @method Index indexNormal(string $name, $columns)
 * @method Index indexUnique(string $name, $columns)
 * @method Index indexPrimary(string $name, $columns)
 * @method Index indexFullText(string $name, $columns)
 * @method Table setIsTemporary($enable = true)
 * @method Table setIfNotExists($enable = true)
 * @method Table setTableName(string $name)
 * @method Table setTableEngine(string $engine)
 * @method Table setTableComment(string $comment)
 * @method Table setTableCharset(string $charset)
 * @method Table setTableAutoIncrement(int $startIncrement)
 * @method Table __createDDL()
 * @method Table __toString()
 * 创建表结构描述
 * 暂只支持创建表 CREATE 结构
 * Class Table
 * @package EasySwoole\Mysqli\DDLBuilder\Blueprints
 */
class Table extends \EasySwoole\DDL\Blueprint\Create\Table
{
    function __construct($tableName)
    {
        parent::__construct($tableName);
    }
}