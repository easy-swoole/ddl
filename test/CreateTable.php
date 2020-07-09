<?php
/**
 * Created by PhpStorm.
 * User: mayn
 * Date: 2019/9/4
 * Time: 23:46
 */

namespace EasySwoole\DDL\Test;

require_once '../vendor/autoload.php';

use EasySwoole\DDL\Blueprint\Create\Table as CreateTable;
use EasySwoole\DDL\DDLBuilder;
use EasySwoole\DDL\Enum\Character;
use EasySwoole\DDL\Enum\Engine;
use EasySwoole\DDL\Enum\Foreign;

$stuQql = DDLBuilder::create('student', function (CreateTable $table) {
    $table->ifNotExists()->comment('学生表');          //设置表名称
    $table->charset(Character::UTF8MB4_GENERAL_CI);     //设置表字符集
    $table->engine(Engine::INNODB);                     //设置表引擎
    $table->autoIncrement(100);                    //设置表起始自增数
    $table->int('stu_id')->autoIncrement()->primaryKey()->unsigned()->comment('学生ID');  //创建stu_id设置主键并自动增长
    $table->varchar('stu_name', 30)->comment('学生姓名');
    $table->char('sex', 1)->comment('性别：1男，2女')->default(1);
    $table->date('birthday')->notNull(false)->comment('出生日期');
    $table->int('created_at', 10)->comment('创建时间');
    $table->int('updated_at', 10)->comment('更新时间');
    $table->normal('ind_stu_name', 'stu_name')->comment('学生姓名--普通索引');//设置索引
});
echo $stuQql . PHP_EOL;

$courseSql = DDLBuilder::create('course', function (CreateTable $table) {
    $table->ifNotExists()->comment('课程表');          //设置表名称
    $table->charset(Character::UTF8MB4_GENERAL_CI);     //设置表字符集
    $table->engine(Engine::INNODB);                     //设置表引擎
    $table->int('id', 3)->primaryKey()->autoIncrement()->unsigned()->zeroFill()->comment('课程id');
    $table->varchar('course_name', 100)->comment('课程名称');
    $table->char('status', 1)->default(1)->comment('课程状态：1正常，0隐藏');
    $table->int('created_at', 10)->comment('创建时间');
    $table->int('updated_at', 10)->comment('更新时间');
    $table->unique('uni_course_name', 'course_name')->comment('课程名称--唯一索引');//设置索引
});
echo $courseSql . PHP_EOL;

$scoreSql = DDLBuilder::create('score', function (CreateTable $table) {
    $table->ifNotExists()->comment('成绩表');          //设置表名称
    $table->charset(Character::UTF8MB4_GENERAL_CI);     //设置表字符集
    $table->engine(Engine::INNODB);                     //设置表引擎
    $table->int('id')->unsigned()->autoIncrement()->primaryKey()->comment('自增ID');
    $table->int('stu_id')->unsigned()->comment('学生id');
    $table->int('course_id')->unsigned()->zeroFill()->comment('课程id');
    $table->float('score', 3, 1)->comment('成绩');
    $table->int('created_at', 10)->comment('创建时间');
    $table->foreign(null,'stu_id','student','stu_id')
        ->onDelete(Foreign::CASCADE)->onUpdate(Foreign::CASCADE);
});
echo $scoreSql;

//以下是输出sql语句
/*
CREATE TABLE IF NOT EXISTS `student` (
  `stu_id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT '学生ID',
  `stu_name` varchar(30) NOT NULL COMMENT '学生姓名',
  `sex` char(1) NOT NULL DEFAULT 1 COMMENT '性别：1男，2女',
  `birthday` date NULL DEFAULT NULL COMMENT '出生日期',
  `created_at` int(10) NOT NULL COMMENT '创建时间',
  `updated_at` int(10) NOT NULL COMMENT '更新时间',
  INDEX `ind_stu_name` (`stu_name`) COMMENT '学生姓名--普通索引'
)
ENGINE = INNODB AUTO_INCREMENT = 100 DEFAULT COLLATE = 'utf8mb4_general_ci' COMMENT = '学生表';


CREATE TABLE IF NOT EXISTS `course` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT '课程id',
  `course_name` varchar(100) NOT NULL COMMENT '课程名称',
  `status` char(1) NOT NULL DEFAULT 1 COMMENT '课程状态：1正常，0隐藏',
  `created_at` int(10) NOT NULL COMMENT '创建时间',
  `updated_at` int(10) NOT NULL COMMENT '更新时间',
  UNIQUE INDEX `uni_course_name` (`course_name`) COMMENT '课程名称--唯一索引'
)
ENGINE = INNODB DEFAULT COLLATE = 'utf8mb4_general_ci' COMMENT = '课程表';


CREATE TABLE IF NOT EXISTS `score` (
  `id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT '自增ID',
  `stu_id` int UNSIGNED NOT NULL COMMENT '学生id',
  `course_id` int UNSIGNED ZEROFILL NOT NULL COMMENT '课程id',
  `score` float(3,1) NOT NULL COMMENT '成绩',
  `created_at` int(10) NOT NULL COMMENT '创建时间',
  FOREIGN KEY (`stu_id`) REFERENCES `student` (`stu_id`) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB DEFAULT COLLATE = 'utf8mb4_general_ci' COMMENT = '成绩表';

*/
