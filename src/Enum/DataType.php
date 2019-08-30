<?php

namespace EasySwoole\DDL\Enum;

use EasySwoole\Spl\SplEnum;

/**
 * 字段类型枚举
 * Class DataType
 * @package EasySwoole\DDL\Enum
 */
class DataType extends SplEnum
{
    // 整型
    const INT = 'int';
    const BIGINT = 'bigint';
    const TINYINT = 'tinyint';
    const SMALLINT = 'smallint';
    const MEDIUMINT = 'mediumint';

    // 小数
    const FLOAT = 'float';
    const DOUBLE = 'double';
    const DECIMAL = 'decimal';

    // 时间
    const DATE = 'date';
    const TIME = 'time';
    const YEAR = 'year';
    const DATETIME = 'datetime';
    const TIMESTAMP = 'timestamp';

    // 字符
    const CHAR = 'char';
    const TEXT = 'text';
    const VARCHAR = 'varchar';
    const TINYTEXT = 'tinytext';
    const MEDIUMTEXT = 'mediumtext';
    const LONGTEXT = 'longtext';

    // 二进制大对象
    const BLOB = 'blob';
    const TINYBLOB = 'tinyblob';
    const MEDIUMBLOB = 'mediumblob';
    const LONGBLOB = 'longblob';

    /**
     * 是否数字类型
     * @param string $type
     * @return bool
     */
    public static function typeIsNumeric(string $type)
    {
        // 全部数字类型
        $numericTypes = [
            DataType::INT,
            DataType::BIGINT,
            DataType::TINYINT,
            DataType::SMALLINT,
            DataType::MEDIUMINT,
            DataType::FLOAT,
            DataType::DOUBLE,
            DataType::DECIMAL
        ];
        return in_array($type, $numericTypes);
    }

    /**
     * 是否文本类型
     * @param string $type
     * @return bool
     */
    public static function typeIsTextual(string $type)
    {
        // 全部文本类型
        $textualType = [
            DataType::CHAR,
            DataType::TEXT,
            DataType::VARCHAR,
            DataType::TINYTEXT,
            DataType::LONGTEXT,
            DataType::MEDIUMTEXT
        ];
        return in_array($type, $textualType);
    }

    /**
     * 是否二进制类型
     * @param string $type
     * @return bool
     */
    public static function typeIsBinary(string $type)
    {
        // 全部二进制类型
        $binaryType = [
            DataType::BLOB,
            DataType::TINYBLOB,
            DataType::LONGBLOB,
            DataType::MEDIUMBLOB
        ];
        return in_array($type, $binaryType);
    }

    /**
     * 是否时间日期类型
     * @param string $type
     * @return bool
     */
    public static function typeIsDatetime(string $type)
    {
        // 全部时间日期类型
        $datetimeType = [
            DataType::DATE,
            DataType::TIME,
            DataType::YEAR,
            DataType::DATETIME,
            DataType::TIMESTAMP,
        ];
        return in_array(strtolower($type), $datetimeType);
    }
}