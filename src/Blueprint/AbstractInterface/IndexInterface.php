<?php

namespace EasySwoole\DDL\Blueprint\AbstractInterface;

/**
 * 索引构造器接口类
 * Class IndexInterface
 * @package EasySwoole\DDL\Blueprint\AbstractInterface
 */
interface IndexInterface
{
    /**
     * 设置索引名称
     * @param string $name
     * @return IndexInterface
     */
    function setIndexName(?string $name = null);

    /**
     * 设置索引类型
     * @param string $type
     * @return IndexInterface
     */
    function setIndexType(string $type);

    /**
     * 设置索引字段
     * @param string|array $columns 可以设置字符串和数组
     * @return IndexInterface
     */
    function setIndexColumns($columns);

    /**
     * 设置索引备注
     * @param string $comment
     * @return IndexInterface
     */
    function setIndexComment(string $comment);
}
