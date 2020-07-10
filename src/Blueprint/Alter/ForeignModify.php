<?php

namespace EasySwoole\DDL\Blueprint\Alter;

/**
 * 外键构造器
 * Class ForeignModify
 * @package EasySwoole\DDL\Blueprint\Alter
 */
class ForeignModify
{
    /** @var ForeignAdd */
    protected $foreignAddObj;

    /**
     * Foreign constructor.
     * @param string|null $foreignName
     * @param string $localColumn
     * @param string $relatedTableName
     * @param string $foreignColumn
     * @return ForeignAdd
     */
    public function foreign(?string $foreignName, string $localColumn, string $relatedTableName, string $foreignColumn)
    {
        $this->foreignAddObj = new ForeignAdd($foreignName, $localColumn, $relatedTableName, $foreignColumn);
        return $this->foreignAddObj;
    }

    /**
     * 主表删除操作从表动作
     * \EasySwoole\DDL\Enum\Foreign
     * @param string $option
     * @return ForeignModify
     */
    public function onDelete(string $option): ForeignModify
    {
        $this->foreignAddObj->setOnDelete($option);
        return $this;
    }

    /**
     * 主表更新操作从表动作
     * \EasySwoole\DDL\Enum\Foreign
     * @param string $option
     * @return ForeignModify
     */
    public function onUpdate(string $option): ForeignModify
    {
        $this->foreignAddObj->setOnUpdate($option);
        return $this;
    }

    /**
     * 生成索引DDL结构
     * 带有下划线的方法请不要自行调用
     * @return string
     */
    public function __createDDL()
    {
        return $this->foreignAddObj->__createDDL();
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