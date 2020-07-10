<?php

namespace EasySwoole\DDL\Blueprint\AbstractInterface;

use EasySwoole\DDL\Enum\DataType;
use InvalidArgumentException;

/**
 * 字段构造器抽象类
 * Class ColumnAbstract
 * @package EasySwoole\DDL\Blueprint\AbstractInterface
 */
abstract class ColumnAbstract implements ColumnInterface
{
    protected $columnName;          // 字段名称
    protected $columnType;          // 字段类型
    protected $columnLimit;         // 字段限制 如 INT(11) / decimal(10,2) 括号部分
    protected $columnComment;       // 字段注释
    protected $columnCharset;       // 字段编码
    protected $isBinary;            // 二进制 (只允许在字符串类型上设置)
    protected $isUnique;            // 唯一的 (请勿重复设置索引UNI)
    protected $unsigned;            // 无符号 (仅数字类型可以设置)
    protected $zeroFill;            // 零填充 (仅数字类型可以设置)
    protected $defaultValue;        // 默认值 (非TEXT/BLOB可以设置)
    protected $isNotNull = true;    // 字段可空 (默认已经设置全部字段不可空)
    protected $autoIncrement;       // 字段自增 (仅数字类型可以设置)
    protected $isPrimaryKey;        // 主键字段 (请勿重复设置索引PK)

    /**
     * 设置字段名称
     * @param string $name 字段名称
     * @return ColumnAbstract
     */
    public function setColumnName(string $name)
    {
        $name = trim($name);
        if (empty($name)) {
            throw new InvalidArgumentException('The column name cannot be empty');
        }
        $this->columnName = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getColumnName()
    {
        return $this->columnName;
    }

    /**
     * 设置字段类型
     * @param string $type
     * @return ColumnAbstract
     */
    public function setColumnType(string $type)
    {
        $type = trim($type);
        if (!DataType::isValidValue($type)) {
            throw new InvalidArgumentException('The column type ' . $type . ' is invalid');
        }
        $this->columnType = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getColumnType()
    {
        return $this->columnType;
    }

    /**
     * 设置字段列宽限制
     * @param integer|array $limit
     * @return ColumnAbstract
     */
    public function setColumnLimit($limit)
    {
        // TODO 暂未做规范判断
        // 此处根据类型的不同实际上还应该判断 TEXT/BLOB 不可能存在limit
        // 另外数字类型如 INT DisplayWidth < 256 | DECIMAL (1,5) 总精度必须大于小数部分精度等限制
        $this->columnLimit = $limit;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getColumnLimit()
    {
        return $this->columnLimit;
    }

    /**
     * 设置字段备注
     * @param string $comment
     * @return ColumnAbstract
     */
    function setColumnComment(string $comment)
    {
        $this->columnComment = $comment;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getColumnComment()
    {
        return $this->columnComment;
    }

    /**
     * 设置字段编码
     * @param string $charset
     * @return ColumnAbstract
     */
    function setColumnCharset(string $charset)
    {
        $this->columnCharset = $charset;
        return $this;
    }

    /**
     * @return mixed
     */
    function getColumnCharset()
    {
        return $this->columnCharset;
    }

    /**
     * 是否零填充
     * @param bool $enable
     * @return ColumnAbstract
     */
    function setZeroFill(bool $enable = true)
    {
        $this->zeroFill = $enable;
        return $this;
    }

    /**
     * @return mixed
     */
    function getZeroFill()
    {
        return $this->zeroFill;
    }

    /**
     * 是否无符号
     * @param bool $enable
     * @return ColumnAbstract
     */
    public function setIsUnsigned(bool $enable = true)
    {
        // TODO 暂未做规范判断
        // 同样需要做规范判断 字段为文本/日期时间/BLOB时不能设置为无符号
        $this->unsigned = $enable;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUnsigned()
    {
        return $this->unsigned;
    }

    /**
     * 字段默认值
     * @param $value
     * @return ColumnAbstract
     */
    function setDefaultValue($value)
    {
        // TODO 暂未做规范判断
        // 同样需要做规范判断 字段为文本/BLOB时不能设置默认值
        $this->defaultValue = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * 设置不可空
     * @param bool $enable
     * @return ColumnAbstract
     */
    function setIsNotNull(bool $enable = true)
    {
        $this->isNotNull = $enable;
        return $this;
    }

    /**
     * @return bool
     */
    function getIsNotNull()
    {
        return $this->isNotNull;
    }

    /**
     * 是否值自增
     * @param bool $enable
     * @return ColumnAbstract
     */
    function setIsAutoIncrement(bool $enable = true)
    {
        // TODO 暂未做规范判断
        // 同样需要做规范判断 只有数字类型才允许自增
        $this->autoIncrement = $enable;
        return $this;
    }


    /**
     * @return mixed
     */
    function getIsAutoIncrement()
    {
        return $this->autoIncrement;
    }
    // 原始方法
    // function getAutoIncrement(){
    //     return $this->autoIncrement;
    // }

    /**
     * 是否二进制
     * 在字符列上设置了二进制会使得该列严格区分大小写
     * @param bool $enable
     * @return ColumnAbstract
     */
    function setIsBinary(bool $enable = true)
    {
        // TODO 暂未做规范判断
        // 同样需要做规范判断 只有字符串类型才允许二进制
        $this->isBinary = $enable;
        return $this;
    }

    /**
     * @return mixed
     */
    function getIsBinary()
    {
        return $this->isBinary;
    }

    /**
     * 直接在字段上设置PK
     * 请不要和索引互相重复设置
     * @param bool $enable
     * @return ColumnAbstract
     */
    function setIsPrimaryKey(bool $enable = true)
    {
        $this->isPrimaryKey = $enable;
        return $this;
    }

    /**
     * @return mixed
     */
    function getIsPrimaryKey()
    {
        return $this->isPrimaryKey;
    }

    /**
     * 字段设置为Unique
     * 请不要和索引互相重复设置
     * @param bool $enable
     * @return ColumnAbstract
     */
    function setIsUnique(bool $enable = true)
    {
        $this->isUnique = $enable;
        return $this;
    }

    function getIsUnique()
    {
        return $this->isUnique;
    }

    abstract public function __createDDL();

    /**
     * 转化为字符串
     * @return string
     */
    function __toString()
    {
        return $this->__createDDL();
    }
}
