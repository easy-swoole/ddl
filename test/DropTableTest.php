<?php
declare(strict_types=1);

namespace EasySwoole\DDL\Test;

use EasySwoole\DDL\DDLBuilder;
use PHPUnit\Framework\TestCase;

class DropTableTest extends TestCase
{
    public function testDropTable()
    {
        $dropStuScoreSql = DDLBuilder::drop('student_score');
        $this->assertSame('DROP TABLE `student_score`;', $dropStuScoreSql);

        $dropStuScoreSql = DDLBuilder::dropIfExists('student_score');
        $this->assertSame('DROP TABLE IF EXISTS `student_score`;', $dropStuScoreSql);
    }
}
