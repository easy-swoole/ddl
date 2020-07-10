<?php

namespace EasySwoole\DDL\Blueprint\Alter;

use EasySwoole\DDL\Enum\Alter;
use \EasySwoole\DDL\Enum\Foreign as ForeignType;
use InvalidArgumentException;

/**
 * 外键构造器
 * Class ForeignAdd
 * @package EasySwoole\DDL\Blueprint\Alter
 */
class ForeignAdd
{
    protected $foreignName;         // 外键名称
    protected $localColumn;         // 从表字段
    protected $relatedTableName;    // 主表表名
    protected $foreignColumn;       // 主表字段
    protected $onDelete;            // 主表删除操作从表动作
    protected $onUpdate;            // 主表更新操作从表动作

    protected $foreignOption = [
        ForeignType::CASCADE,
        ForeignType::NO_ACTION,
        ForeignType::RESTRICT,
        ForeignType::SET_NULL,
    ];

    /**
     * Foreign constructor.
     * @param string|null $foreignName
     * @param string $localColumn
     * @param string $relatedTableName
     * @param string $foreignColumn
     */
    public function __construct(?string $foreignName, string $localColumn, string $relatedTableName, string $foreignColumn)
    {
        $this->setForeignName($foreignName);
        $this->setLocalColumn($localColumn);
        $this->setRelatedTableName($relatedTableName);
        $this->setForeignColumn($foreignColumn);
    }

    /**
     * 设置外键名称
     * @param string|null $foreignName
     * @return ForeignAdd
     */
    public function setForeignName(?string $foreignName = null): ForeignAdd
    {
        $this->foreignName = is_string($foreignName) ? trim($foreignName) : null;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getForeignName()
    {
        return $this->foreignName;
    }

    /**
     * 设置从表字段
     * @param string $localColumn
     * @return ForeignAdd
     */
    public function setLocalColumn(string $localColumn): ForeignAdd
    {
        $localColumn = trim($localColumn);
        if (empty($localColumn)) {
            throw new InvalidArgumentException('The local column cannot be empty');
        }
        $this->localColumn = $localColumn;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocalColumn()
    {
        return $this->localColumn;
    }

    /**
     * 设置主表表名
     * @param string $relatedTableName
     * @return ForeignAdd
     */
    public function setRelatedTableName(string $relatedTableName): ForeignAdd
    {
        $relatedTableName = trim($relatedTableName);
        if (empty($relatedTableName)) {
            throw new InvalidArgumentException('The related table name cannot be empty');
        }
        $this->relatedTableName = $relatedTableName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRelatedTableName()
    {
        return $this->relatedTableName;
    }

    /**
     * 设置主表字段
     * @param string $foreignColumn
     * @return ForeignAdd
     */
    public function setForeignColumn(string $foreignColumn): ForeignAdd
    {
        $foreignColumn = trim($foreignColumn);
        if (empty($foreignColumn)) {
            throw new InvalidArgumentException('The foreign column cannot be empty');
        }
        $this->foreignColumn = trim($foreignColumn);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getForeignColumn()
    {
        return $this->foreignColumn;
    }

    /**
     * 主表删除操作从表动作
     * \EasySwoole\DDL\Enum\Foreign
     * @param string $option
     * @return ForeignAdd
     */
    public function setOnDelete(string $option): ForeignAdd
    {
        $option = trim($option);
        if (!in_array($option, $this->foreignOption)) {
            throw new InvalidArgumentException('on delete option is invalid');
        }
        $this->onDelete = $option;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOnDelete()
    {
        return $this->onDelete;
    }

    /**
     * 主表更新操作从表动作
     * \EasySwoole\DDL\Enum\Foreign
     * @param string $option
     * @return ForeignAdd
     */
    public function setOnUpdate(string $option): ForeignAdd
    {
        $option = trim($option);
        if (!in_array($option, $this->foreignOption)) {
            throw new InvalidArgumentException('on update option is invalid');
        }
        $this->onUpdate = $option;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOnUpdate()
    {
        return $this->onUpdate;
    }

    /**
     * 生成索引DDL结构
     * 带有下划线的方法请不要自行调用
     * @return string
     */
    public function __createDDL()
    {
        return implode(' ',
            array_filter(
                [
                    Alter::ADD,
                    $this->getForeignName() ? "CONSTRAINT `{$this->getForeignName()}`" : null,
                    "FOREIGN KEY (`{$this->getLocalColumn()}`)",
                    "REFERENCES `{$this->getRelatedTableName()}` (`{$this->getForeignColumn()}`)",
                    $this->getOnDelete() ? "ON DELETE {$this->getOnDelete()}" : null,
                    $this->getOnUpdate() ? "ON UPDATE {$this->getOnUpdate()}" : null,
                ]
            )
        );
    }

    /**
     * 转化为字符串
     * @return string
     */
    public function __toString()
    {
        return $this->__createDDL();
    }
}