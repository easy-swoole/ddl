<?php

namespace EasySwoole\DDL\Blueprint\Create;

use \EasySwoole\DDL\Enum\Foreign as ForeignType;
use InvalidArgumentException;

/**
 * 外键构造器
 * Class Foreign
 * @package EasySwoole\DDL\Blueprint\Create
 */
class Foreign
{
    protected $foreignName;         // 外键名称
    protected $localColumn;         // 从表字段
    protected $relatedTableName;    // 主表表名
    protected $foreignColumn;       // 主表字段
    protected $onDelete;            // 主表删除操作从表动作
    protected $onUpdate;            // 主表更新操作从表动作

    protected $ForeignOption = [
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
    function __construct(?string $foreignName, string $localColumn, string $relatedTableName, string $foreignColumn)
    {
        $this->setForeignName($foreignName);
        $this->setLocalColumn($localColumn);
        $this->setRelatedTableName($relatedTableName);
        $this->setForeignColumn($foreignColumn);
    }

    /**
     * 设置外键名称
     * @param string|null $foreignName
     * @return Foreign
     */
    private function setForeignName(?string $foreignName = null): Foreign
    {
        $this->foreignName = is_string($foreignName) ? trim($foreignName) : null;
        return $this;
    }

    /**
     * 设置从表字段
     * @param string $localColumn
     * @return Foreign
     */
    private function setLocalColumn(string $localColumn): Foreign
    {
        $localColumn = trim($localColumn);
        if (empty($localColumn)) {
            throw new InvalidArgumentException('localColumn is miss');
        }
        $this->localColumn = $localColumn;
        return $this;
    }

    /**
     * 设置主表表名
     * @param string $relatedTableName
     * @return Foreign
     */
    private function setRelatedTableName(string $relatedTableName): Foreign
    {
        $relatedTableName = trim($relatedTableName);
        if (empty($relatedTableName)) {
            throw new InvalidArgumentException('relatedTableName is miss');
        }
        $this->relatedTableName = $relatedTableName;
        return $this;
    }

    /**
     * 设置主表字段
     * @param string $foreignColumn
     * @return Foreign
     */
    private function setForeignColumn(string $foreignColumn): Foreign
    {
        $foreignColumn = trim($foreignColumn);
        if (empty($foreignColumn)) {
            throw new InvalidArgumentException('foreignColumn is miss');
        }
        $this->foreignColumn = trim($foreignColumn);
        return $this;
    }

    /**
     * 主表删除操作从表动作
     * \EasySwoole\DDL\Enum\Foreign
     * @param string $option
     * @return Foreign
     */
    function onDelete(string $option)
    {
        $option = trim($option);
        if (!in_array($option, $this->ForeignOption)) {
            throw new InvalidArgumentException('on delete option is invalid');
        }
        $this->onDelete = $option;
        return $this;
    }

    /**
     * 主表更新操作从表动作
     * \EasySwoole\DDL\Enum\Foreign
     * @param string $option
     * @return Foreign
     */
    function onUpdate(string $option)
    {
        $option = trim($option);
        if (!in_array($option, $this->ForeignOption)) {
            throw new InvalidArgumentException('on update option is invalid');
        }
        $this->onUpdate = $option;
        return $this;
    }

    /**
     * 生成索引DDL结构
     * 带有下划线的方法请不要自行调用
     * @return string
     */
    function __createDDL()
    {
        return implode(' ',
            array_filter(
                [
                    $this->foreignName ? "CONSTRAINT `{$this->foreignName}`" : null,
                    "FOREIGN KEY (`{$this->localColumn}`)",
                    "REFERENCES `{$this->relatedTableName}` (`{$this->foreignColumn}`)",
                    $this->onDelete ? "ON DELETE {$this->onDelete}" : null,
                    $this->onUpdate ? "ON UPDATE {$this->onUpdate}" : null,
                ]
            )
        );
    }

    /**
     * 转化为字符串
     * @return string
     */
    function __toString()
    {
        return $this->__createDDL();
    }
}