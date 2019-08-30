<?php


namespace EasySwoole\DDL\Enum;


use EasySwoole\Spl\SplEnum;

class Index extends SplEnum
{
    const NORMAL = 'normal';
    const UNIQUE = 'unique';
    const PRIMARY = 'primary';
    const FULLTEXT = 'fulltext';
}