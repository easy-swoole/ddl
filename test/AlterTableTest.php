<?php
declare(strict_types=1);

namespace EasySwoole\DDL\Test;

use EasySwoole\DDL\Blueprint\Alter\Table as AlterTable;
use EasySwoole\DDL\DDLBuilder;
use PHPUnit\Framework\TestCase;

class AlterTableTest extends TestCase
{
    public function testAlterTable1()
    {
        $alterStuInfoSql = DDLBuilder::alter('student', function (AlterTable $table) {
            $table->setRenameTable('student_info')->setTableComment('学生信息表');
            $table->dropColumn('age');
            $table->dropIndex('ind_age');
            $table->modifyColumn()->varchar('stu_name', 50)->setColumnComment('学生姓名');
            $table->changeColumn('sex')->tinyint('gender', 1)->setDefaultValue('2')->setColumnComment('性别：1男，2未知');
            $table->changeColumn("info")->json('ext_info')->setColumnComment('学生扩展信息');
            $table->addColumn()->json('ext_other')->setColumnComment('其他扩展信息');
            $table->modifyIndex('ind_stu_name')->normal('ind_stu_name', 'stu_name')->setIndexComment('学生姓名--普通索引');
            $table->addColumn()->varchar('phone', 30)->setColumnComment('学生联系方式');
            $table->addIndex()->normal('ind_phone', 'phone')->setIndexComment('学生联系方式-普通索引');
        });

        $expectedSql = "ALTER TABLE `student` RENAME TO `student_info`;
ALTER TABLE `student_info` 
COMMENT = '学生信息表',
DROP `age`,
CHANGE `sex` `gender` tinyint(1) NOT NULL DEFAULT '2' COMMENT '性别：1男，2未知',
CHANGE `info` `ext_info` json NOT NULL COMMENT '学生扩展信息',
MODIFY `stu_name` varchar(50) NOT NULL COMMENT '学生姓名',
ADD `ext_other` json NOT NULL COMMENT '其他扩展信息',
ADD `phone` varchar(30) NOT NULL COMMENT '学生联系方式',
DROP INDEX `ind_age`,
DROP INDEX `ind_stu_name`,
ADD INDEX `ind_stu_name` (`stu_name`) COMMENT '学生姓名--普通索引',
ADD INDEX `ind_phone` (`phone`) COMMENT '学生联系方式-普通索引';";
        $this->assertSame($expectedSql, $alterStuInfoSql);
    }

    public function testAlterTable2()
    {
        $alterStuScoreSql = DDLBuilder::alter('score', function (AlterTable $table) {
            $table->setRenameTable('student_score')->setTableComment('学生成绩表');
            $table->dropForeign('fk_course_id');
            $table->addIndex()->normal('ind_score', 'score')->setIndexComment('学生成绩--普通索引');
            $table->modifyForeign('fk_stu_id')->foreign('fk_stu_id', 'stu_id', 'student_info', 'stu_id');
        });

        $expectedSql = "ALTER TABLE `score` RENAME TO `student_score`;
ALTER TABLE `student_score` 
COMMENT = '学生成绩表',
ADD INDEX `ind_score` (`score`) COMMENT '学生成绩--普通索引';
ALTER TABLE `student_score` DROP FOREIGN KEY `fk_course_id`;
ALTER TABLE `student_score` DROP FOREIGN KEY `fk_stu_id`;
ALTER TABLE `student_score` ADD CONSTRAINT `fk_stu_id` FOREIGN KEY (`stu_id`) REFERENCES `student_info` (`stu_id`);";
        $this->assertSame($expectedSql, $alterStuScoreSql);
    }
}
