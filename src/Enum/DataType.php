<?php

namespace EasySwoole\DDL\Enum;

/**
 * 字段类型枚举
 * Class DataType
 * @package EasySwoole\DDL\Enum
 */
enum DataType: string
{
    // 整型
    case INT = 'int';
    case INTEGER = 'integer';
    case BIGINT = 'bigint';
    case TINYINT = 'tinyint';
    case SMALLINT = 'smallint';
    case MEDIUMINT = 'mediumint';

    // 小数 前面的要大于后面的
    case FLOAT = 'float';
    case DOUBLE = 'double';
    case DECIMAL = 'decimal';

    // 时间
    case DATE = 'date';
    case TIME = 'time';
    case YEAR = 'year';
    case DATETIME = 'datetime';
    case TIMESTAMP = 'timestamp';

    // 字符
    case CHAR = 'char';
    case TEXT = 'text';
    case VARCHAR = 'varchar';
    case TINYTEXT = 'tinytext';
    case MEDIUMTEXT = 'mediumtext';
    case LONGTEXT = 'longtext';

    // 二进制大对象
    case BLOB = 'blob';
    case TINYBLOB = 'tinyblob';
    case MEDIUMBLOB = 'mediumblob';
    case LONGBLOB = 'longblob';

    case BINARY = 'binary';

    case VARBINARY = 'varbinary';

    case JSON = 'json';

    case BIT = 'bit';

    case ENUM = 'enum';

    case GEOMETRY = 'geometry';

    case GEOMETRYCOLLECTION = 'geometrycollection';

    case LINESTRING = 'linestring';

    case MULTILINESTRING = 'multilinestring';

    case MULTIPOINT = 'multipoint';

    case MULTIPOLYGON = 'multipolygon';

    case NUMERIC = 'numeric';

    case POINT = 'point';

    case POLYGON = 'polygon';

    case REAL = 'real';

    case SET = 'set';

    private static function getEnums(): array
    {
        try {
            return (new \ReflectionClass(static::class))->getConstants();
        } catch (\Throwable $throwable) {
            return [];
        }
    }

    /**
     * 是否数字类型
     * @param string $type
     * @return bool
     */
    public static function typeIsNumeric(string $type)
    {
        // 全部数字类型
        $numericTypes = [
            DataType::INT->value,
            DataType::INTEGER->value,
            DataType::BIGINT->value,
            DataType::TINYINT->value,
            DataType::SMALLINT->value,
            DataType::MEDIUMINT->value,
            DataType::FLOAT->value,
            DataType::DOUBLE->value,
            DataType::DECIMAL->value,
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
            DataType::CHAR->value,
            DataType::TEXT->value,
            DataType::VARCHAR->value,
            DataType::TINYTEXT->value,
            DataType::LONGTEXT->value,
            DataType::MEDIUMTEXT->value,
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
            DataType::BLOB->value,
            DataType::TINYBLOB->value,
            DataType::LONGBLOB->value,
            DataType::MEDIUMBLOB->value,
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
            DataType::DATE->value,
            DataType::TIME->value,
            DataType::YEAR->value,
            DataType::DATETIME->value,
            DataType::TIMESTAMP->value,
        ];

        return in_array(strtolower($type), $datetimeType);
    }

    public static function isValidValue($val)
    {
        return $val instanceof DataType;
    }
}
