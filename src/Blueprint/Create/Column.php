<?php

namespace EasySwoole\DDL\Blueprint\Create;

use EasySwoole\DDL\Blueprint\AbstractInterface\ColumnAbstract;
use EasySwoole\DDL\Enum\DataType;
use EasySwoole\DDL\Filter\FilterLimit;
use EasySwoole\DDL\Filter\FilterUnsigned;
use EasySwoole\DDL\Filter\FilterZerofill;
use InvalidArgumentException;

/**
 * 建表字段构造器
 * Class Column
 * @package EasySwoole\DDL\Blueprint\Create
 */
class Column extends ColumnAbstract
{
    /**
     * Column constructor.
     * @param string $columnName 列的名称
     * @param string $columnType 列的类型
     */
    function __construct(string $columnName, string $columnType)
    {
        $this->setColumnName($columnName);
        $this->setColumnType($columnType);
    }

    /**
     * 处理字段的默认值
     * @return bool|string
     */
    private function parseDefaultValue()
    {
        // AUTO_INCREMENT 和默认值不能同时出现
        if ($this->autoIncrement) {
            return false;
        }
        // 如果当前允许NULL值 而没有设置默认值 那么默认就为NULL
        if (!$this->isNotNull && ($this->defaultValue == null || $this->defaultValue == 'NULL')) {
            return 'NULL';
        }

        // 否则字段是不允许NULL值的 如果默认值是文本应该加入引号
        if (is_string($this->defaultValue)) {
            return "'" . $this->defaultValue . "'";
        } else if (is_bool($this->defaultValue)) {  // 布尔类型强转0和1
            return $this->defaultValue ? '1' : '0';
        } else if (is_null($this->defaultValue)) {
            return false;
        } else {  // 其他类型强转String
            return (string)$this->defaultValue;
        }
    }

    /**
     * 处理字段的类型宽度限制
     * @return bool|string
     */
    private function parseColumnLimit()
    {
        // 是一个数组需要用逗号接起来
        if (is_array($this->columnLimit)) {
            return "(" . implode(',', $this->columnLimit) . ")";
        }
        // 是一个数字可以直接设置在类型后面
        if (is_numeric($this->columnLimit)) {
            return "(" . $this->columnLimit . ")";
        }
        // 否则没有设置
        return false;
    }

    /**
     * 处理数据类型
     * @return string
     */
    private function parseDataType()
    {
        $columnLimit = $this->parseColumnLimit();
        $columnType  = $this->columnType;
        if ($columnLimit) {
            $columnType .= $columnLimit;
        }
        return $columnType;
    }

    /**
     * 创建DDL
     * 带下划线的方法请不要外部调用
     * @return string
     */
    function __createDDL(): string
    {
        FilterLimit::run($this);//检测limit是否合法
        FilterUnsigned::run($this); //检测无符号类型
        FilterZerofill::run($this); //检测是否补充长度
        $default       = $this->parseDefaultValue();
        $columnCharset = $this->columnCharset ? explode('_', $this->columnCharset)[0] : false;
        return implode(' ',
            array_filter(
                [
                    '`' . $this->columnName . '`',
                    (string)$this->parseDataType(),
                    $this->isBinary ? 'BINARY' : null,
                    $this->columnCharset ? 'CHARACTER SET ' . strtoupper($columnCharset) . ' COLLATE ' . strtoupper($this->columnCharset) : null,
                    $this->unsigned ? 'UNSIGNED' : null,
                    $this->zeroFill ? 'ZEROFILL' : null,
                    $this->isUnique ? 'UNIQUE' : null,
                    $this->isNotNull ? 'NOT NULL' : 'NULL',
                    $default !== false ? 'DEFAULT ' . $default : null,
                    $this->isPrimaryKey ? 'PRIMARY KEY' : null,
                    $this->autoIncrement ? 'AUTO_INCREMENT' : null,
                    $this->columnComment ? sprintf("COMMENT '%s'", addslashes($this->columnComment)) : null
                ]
            )
        );
    }

}
