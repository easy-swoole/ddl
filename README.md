# DDL
数据库模式定义语言DDL(Data Definition Language)，是用于描述数据库中要存储的现实世界实体的语言。  
其实就是我们在创建表的时候用到的一些sql，比如说：CREATE、ALTER、DROP等。

## 测试代码

#### CreateTable
```php
use EasySwoole\DDL\Blueprint\Create\Table as CreateTable;
use EasySwoole\DDL\DDLBuilder;
use EasySwoole\DDL\Enum\Character;
use EasySwoole\DDL\Enum\Engine;
use EasySwoole\DDL\Enum\Foreign;

$sql = DDLBuilder::create('user', function (CreateTable $table) {
    $table->setIfNotExists()->setTableComment('用户表');   //设置表名称/
    $table->setTableEngine(Engine::MYISAM);                //设置表引擎
    $table->setTableCharset(Character::UTF8MB4_GENERAL_CI);//设置表字符集
    $table->int('user_id', 10)->setColumnComment('用户ID')->setIsAutoIncrement()->setIsPrimaryKey();  //创建user_id设置主键并自动增长
    $table->varchar('username', 30)->setIsNotNull()->setColumnComment('用户名')->setDefaultValue('');
    $table->char('sex', 1)->setIsNotNull()->setColumnComment('性别：1男，2女')->setDefaultValue(1);
    $table->tinyint('age')->setIsNotNull()->setColumnComment('年龄')->setIsUnsigned();
    $table->text('intro')->setIsNotNull()->setColumnComment('简介');
    $table->date('birthday')->setIsNotNull()->setColumnComment('出生日期');
    $table->decimal('money', 10, 2)->setIsNotNull()->setColumnComment('金额')->setDefaultValue(0);
    $table->int('created_at', 10)->setIsNotNull()->setColumnComment('创建时间');
    $table->int('updated_at', 10)->setIsNotNull()->setColumnComment('更新时间');
    $table->unique('username_index', 'username')->setIndexComment('用户名唯一索引');//设置索引
    $table->normal('username_age_index', ['username', 'age'])->setIndexComment('用户名-年龄');
});
//以下是生成的sql的语句
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `sex` char(1) NOT NULL DEFAULT 1 COMMENT '性别：1男，2女',
  `age` tinyint UNSIGNED NOT NULL COMMENT '年龄',
  `intro` text NOT NULL COMMENT '简介',
  `birthday` date NOT NULL COMMENT '出生日期',
  `money` decimal(10,2) NOT NULL DEFAULT 0 COMMENT '金额',
  `created_at` int(10) NOT NULL COMMENT '创建时间',
  `updated_at` int(10) NOT NULL COMMENT '更新时间',
  UNIQUE INDEX `username_index` (`username`) COMMENT '用户名唯一索引',
  INDEX `username_age_index` (`username`,`age`) COMMENT '用户名-年龄'
)
ENGINE = MYISAM DEFAULT COLLATE = 'utf8mb4_general_ci' COMMENT = '用户表';
 
------------------------------------------------------------------------------------
 
$stuSql = DDLBuilder::create('student', function (CreateTable $table) {
    $table->setIfNotExists()->setTableComment('学生表');          //设置表名称
    $table->setTableCharset(Character::UTF8MB4_GENERAL_CI);     //设置表字符集
    $table->setTableEngine(Engine::INNODB);                     //设置表引擎
    $table->setTableAutoIncrement(100);                         //设置表起始自增数
    $table->int('stu_id')->setIsAutoIncrement()->setIsPrimaryKey()->setIsUnsigned()->setColumnComment('学生ID');  //创建stu_id设置主键并自动增长
    $table->varchar('stu_name', 30)->setColumnComment('学生姓名');
    $table->char('sex', 1)->setColumnComment('性别：1男，2女')->setDefaultValue(1);
    $table->date('birthday')->setIsNotNull(false)->setColumnComment('出生日期');
    $table->int('created_at', 10)->setColumnComment('创建时间');
    $table->int('updated_at', 10)->setColumnComment('更新时间');
    $table->normal('ind_stu_name', 'stu_name')->setIndexComment('学生姓名--普通索引');//设置索引
});

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
 
------------------------------------------------------------------------------------
 
$courseSql = DDLBuilder::create('course', function (CreateTable $table) {
    $table->setIfNotExists()->setTableComment('课程表');          //设置表名称
    $table->setTableCharset(Character::UTF8MB4_GENERAL_CI);     //设置表字符集
    $table->setTableEngine(Engine::INNODB);                     //设置表引擎
    $table->int('id', 3)->setIsPrimaryKey()->setIsAutoIncrement()->setIsUnsigned()->setZeroFill()->setColumnComment('课程id');
    $table->varchar('course_name', 100)->setColumnComment('课程名称');
    $table->char('status', 1)->setDefaultValue(1)->setColumnComment('课程状态：1正常，0隐藏');
    $table->int('created_at', 10)->setColumnComment('创建时间');
    $table->int('updated_at', 10)->setColumnComment('更新时间');
    $table->unique('uni_course_name', 'course_name')->setIndexComment('课程名称--唯一索引');//设置索引
});


CREATE TABLE IF NOT EXISTS `course` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT '课程id',
  `course_name` varchar(100) NOT NULL COMMENT '课程名称',
  `status` char(1) NOT NULL DEFAULT 1 COMMENT '课程状态：1正常，0隐藏',
  `created_at` int(10) NOT NULL COMMENT '创建时间',
  `updated_at` int(10) NOT NULL COMMENT '更新时间',
  UNIQUE INDEX `uni_course_name` (`course_name`) COMMENT '课程名称--唯一索引'
)
ENGINE = INNODB DEFAULT COLLATE = 'utf8mb4_general_ci' COMMENT = '课程表';
 
------------------------------------------------------------------------------------
 
$scoreSql = DDLBuilder::create('score', function (CreateTable $table) {
    $table->setIfNotExists()->setTableComment('成绩表');          //设置表名称
    $table->setTableCharset(Character::UTF8MB4_GENERAL_CI);     //设置表字符集
    $table->setTableEngine(Engine::INNODB);                     //设置表引擎
    $table->int('id')->setIsUnsigned()->setIsAutoIncrement()->setIsPrimaryKey()->setColumnComment('自增ID');
    $table->int('stu_id')->setIsUnsigned()->setColumnComment('学生id');
    $table->int('course_id')->setIsUnsigned()->setZeroFill()->setColumnComment('课程id');
    $table->float('score', 3, 1)->setColumnComment('成绩');
    $table->int('created_at', 10)->setColumnComment('创建时间');
    $table->foreign(null,'stu_id','student','stu_id')
        ->setOnDelete(Foreign::CASCADE)->setOnUpdate(Foreign::CASCADE);
});

CREATE TABLE IF NOT EXISTS `score` (
  `id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT '自增ID',
  `stu_id` int UNSIGNED NOT NULL COMMENT '学生id',
  `course_id` int UNSIGNED ZEROFILL NOT NULL COMMENT '课程id',
  `score` float(3,1) NOT NULL COMMENT '成绩',
  `created_at` int(10) NOT NULL COMMENT '创建时间',
  FOREIGN KEY (`stu_id`) REFERENCES `student` (`stu_id`) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB DEFAULT COLLATE = 'utf8mb4_general_ci' COMMENT = '成绩表';

```

#### AlterTable
```php
use EasySwoole\DDL\Blueprint\Alter\Table as AlterTable;
use EasySwoole\DDL\DDLBuilder;

$alterStuInfoSql = DDLBuilder::alter('student', function (AlterTable $table) {
    $table->setRenameTable('student_info')->setTableComment('学生信息表');
    $table->modifyIndex('ind_stu_name')->normal('ind_stu_name', 'stu_name')->setIndexComment('学生姓名--普通索引');
});

ALTER TABLE `student` RENAME TO `student_info`;
ALTER TABLE `student_info` 
COMMENT = '学生信息表',
DROP INDEX `ind_stu_name`,
ADD INDEX `ind_stu_name` (`stu_name`) COMMENT '学生姓名--普通索引';

------------------------------------------------------------------------------------
$alterStuScoreSql = DDLBuilder::alter('score', function (AlterTable $table) {
    $table->setRenameTable('student_score')->setTableComment('学生成绩表');
    $table->modifyIndex('ind_score')->normal('ind_score', 'score')->setIndexComment('学生成绩--普通索引');
    $table->modifyForeign('fk_stu_id')->foreign('fk_stu_id', 'stu_id', 'student_info', 'stu_id');
});

ALTER TABLE `score` RENAME TO `student_score`;
ALTER TABLE `student_score` 
COMMENT = '学生成绩表',
DROP INDEX `ind_score`,
ADD INDEX `ind_score` (`score`) COMMENT '学生成绩--普通索引';
ALTER TABLE `student_score` DROP FOREIGN KEY `fk_stu_id`;
ALTER TABLE `student_score` ADD CONSTRAINT `fk_stu_id` FOREIGN KEY (`stu_id`) REFERENCES `student_info` (`stu_id`);
```

#### DropTable
```php
use EasySwoole\DDL\DDLBuilder;

$stuSql = DDLBuilder::drop('student');

DROP TABLE `student`;

------------------------------------------------------------------------------------
$stuSql = DDLBuilder::dropIfExists('student');

DROP TABLE IF EXISTS `student`;
```
