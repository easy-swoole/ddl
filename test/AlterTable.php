<?php
/**
 * Created by PhpStorm.
 * User: mayn
 * Date: 2019/9/4
 * Time: 23:46
 */

namespace EasySwoole\DDL\Test;

require_once '../vendor/autoload.php';

use EasySwoole\DDL\Blueprint\Alter\Table as AlterTable;
use EasySwoole\DDL\Blueprint\Create\Table as CreateTable;
use EasySwoole\DDL\DDLBuilder;
use EasySwoole\DDL\Enum\Character;
use EasySwoole\DDL\Enum\Engine;
use EasySwoole\DDL\Enum\Foreign;

$stuSql = DDLBuilder::create('student', function (CreateTable $table) {
    $table->setIfNotExists()->setTableComment('学生表');          //设置表名称
    $table->setTableCharset(Character::UTF8MB4_GENERAL_CI);     //设置表字符集
    $table->setTableEngine(Engine::INNODB);                     //设置表引擎
    $table->setTableAutoIncrement(100);                    //设置表起始自增数
    $table->int('stu_id')->setIsAutoIncrement()->setIsPrimaryKey()->setIsUnsigned()->setColumnComment('学生ID');  //创建stu_id设置主键并自动增长
    $table->varchar('stu_name', 30)->setColumnComment('学生姓名');
    $table->char('sex', 1)->setColumnComment('性别：1男，2女')->setDefaultValue(1);
    $table->date('birthday')->setIsNotNull(false)->setColumnComment('出生日期');
    $table->int('created_at', 10)->setColumnComment('创建时间');
    $table->int('updated_at', 10)->setColumnComment('更新时间');
    $table->fulltext('ind_stu_name', 'stu_name')->setIndexComment('学生姓名--普通索引');
});
echo $stuSql . PHP_EOL . PHP_EOL;

$scoreSql = DDLBuilder::create('score', function (CreateTable $table) {
    $table->setIfNotExists()->setTableComment('成绩表');          //设置表名称
    $table->setTableCharset(Character::UTF8MB4_GENERAL_CI);     //设置表字符集
    $table->setTableEngine(Engine::INNODB);                     //设置表引擎
    $table->int('id')->setIsUnsigned()->setIsAutoIncrement()->setIsPrimaryKey()->setColumnComment('自增ID');
    $table->int('stu_id')->setIsUnsigned()->setColumnComment('学生id');
    $table->int('course_id')->setIsUnsigned()->setZeroFill()->setColumnComment('课程id');
    $table->float('score', 3, 1)->setColumnComment('成绩');
    $table->int('created_at', 10)->setColumnComment('创建时间');
    $table->unique('ind_score', 'score')->setIndexComment('成绩--普通索引');
    $table->foreign('fk_stu_id', 'id', 'student', 'stu_id')
        ->setOnDelete(Foreign::CASCADE)->setOnUpdate(Foreign::CASCADE);
});
echo $scoreSql . PHP_EOL . PHP_EOL;

$alterStuInfoSql = DDLBuilder::alter('student', function (AlterTable $table) {
    $table->setRenameTable('student_info')->setTableComment('学生信息表');
    $table->modifyIndex('ind_stu_name')->normal('ind_stu_name', 'stu_name')->setIndexComment('学生姓名--普通索引');
});
echo $alterStuInfoSql . PHP_EOL . PHP_EOL;


$alterStuScoreSql = DDLBuilder::alter('score', function (AlterTable $table) {
    $table->setRenameTable('student_score')->setTableComment('学生成绩表');
    $table->modifyIndex('ind_score')->normal('ind_score', 'score')->setIndexComment('学生成绩--普通索引');
    $table->modifyForeign('fk_stu_id')->foreign('fk_stu_id', 'stu_id', 'student_info', 'stu_id');
});
echo $alterStuScoreSql . PHP_EOL;

//以下是输出sql语句

/*

CREATE TABLE IF NOT EXISTS `student` (
  `stu_id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT '学生ID',
  `stu_name` varchar(30) NOT NULL COMMENT '学生姓名',
  `sex` char(1) NOT NULL DEFAULT 1 COMMENT '性别：1男，2女',
  `birthday` date NULL DEFAULT NULL COMMENT '出生日期',
  `created_at` int(10) NOT NULL COMMENT '创建时间',
  `updated_at` int(10) NOT NULL COMMENT '更新时间',
  FULLTEXT INDEX `ind_stu_name` (`stu_name`) COMMENT '学生姓名--普通索引'
)
ENGINE = INNODB AUTO_INCREMENT = 100 DEFAULT COLLATE = 'utf8mb4_general_ci' COMMENT = '学生表';

CREATE TABLE IF NOT EXISTS `score` (
  `id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT '自增ID',
  `stu_id` int UNSIGNED NOT NULL COMMENT '学生id',
  `course_id` int UNSIGNED ZEROFILL NOT NULL COMMENT '课程id',
  `score` float(3,1) NOT NULL COMMENT '成绩',
  `created_at` int(10) NOT NULL COMMENT '创建时间',
  UNIQUE INDEX `ind_score` (`score`) COMMENT '成绩--普通索引',
  CONSTRAINT `fk_stu_id` FOREIGN KEY (`id`) REFERENCES `student` (`stu_id`) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB DEFAULT COLLATE = 'utf8mb4_general_ci' COMMENT = '成绩表';

ALTER TABLE `student` RENAME TO `student_info`;
ALTER TABLE `student_info` COMMENT = '学生信息表';
ALTER TABLE `student_info` DROP INDEX `ind_stu_name`;
ALTER TABLE `student_info` ADD INDEX `ind_stu_name` (`stu_name`) COMMENT '学生姓名--普通索引';

ALTER TABLE `score` RENAME TO `student_score`;
ALTER TABLE `student_score` COMMENT = '学生成绩表';
ALTER TABLE `student_score` DROP INDEX `ind_score`;
ALTER TABLE `student_score` ADD INDEX `ind_score` (`score`) COMMENT '学生姓名--普通索引';
ALTER TABLE `student_score` DROP FOREIGN KEY `fk_stu_id`;
ALTER TABLE `student_score` ADD CONSTRAINT `fk_stu_id` FOREIGN KEY (`stu_id`) REFERENCES `student_info` (`stu_id`);

 */
