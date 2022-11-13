<?php

require_once('util4p/util.php');
require_once('util4p/CRObject.class.php');
require_once('util4p/MysqlPDO.class.php');

require_once('config.inc.php');
require_once('init.inc.php');


/* show error for debug purpose */
$config = new CRObject();
$config->set('show_error', true);
MysqlPDO::configure($config);


create_table_user();
create_table_link();
create_table_log();
create_table_query_log();

function execute_sqls($sqls)
{
	foreach ($sqls as $description => $sql) {
		echo "Executing $description: ";
		$res = (new MysqlPDO)->execute($sql, array());
		echo $res ? '<em>Success</em>' : '<em>Failed</em>';
		echo "<hr/>";
	}
}

function create_table_user()
{
	$sqls = array(
//		'DROP `ls_user`' =>
//			'DROP TABLE IF EXISTS `ls_user`',
		'CREATE `ls_user`' =>
			'CREATE TABLE `ls_user`(
				`uid` int AUTO_INCREMENT,
				 PRIMARY KEY (`uid`),
				`open_id` varchar(64) NOT NULL,
				 UNIQUE (`open_id`),
				`email` varchar(64),
				`role` varchar(12) NOT NULL,
				`level` int DEFAULT 0,
				`time` bigint
			)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci'
	);
	execute_sqls($sqls);
}

function create_table_link()
{
	$sqls = array(
//        'DROP `ls_link`' => 'DROP TABLE IF EXISTS `ls_link`',
		'CREATE `ls_link`' =>
			'CREATE TABLE `ls_link`(
				`token` VARCHAR(15) NOT NULL,
				 PRIMARY KEY(`token`),
				 INDEX(`token`),
                `url` varchar(500) NOT NULL,
                `remark` varchar(255),
                `status` int NOT NULL DEFAULT 0,/* 0-normal, 1-paused, 2-disabled, 3-removed */
                `time` BIGINT NOT NULL,
                 INDEX(`time`),
                `valid_from` BIGINT,
                `valid_to` BIGINT,
				`owner` int,
				 INDEX(`owner`)
			)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci',
	);
	execute_sqls($sqls);
}

function create_table_log()
{
	$sqls = array(
//		'DROP `ls_log`' => 'DROP TABLE IF EXISTS `ls_log`',
		'CREATE `ls_log`' =>
			'CREATE TABLE `ls_log`(
		  		`id` BIGINT AUTO_INCREMENT,
	  			 PRIMARY KEY(`id`),
				`scope` VARCHAR(128) NOT NULL,
				 INDEX(`scope`),
				`tag` VARCHAR(128) NOT NULL,
				 INDEX(`tag`),
				`level` INT NOT NULL, /* too small value sets, no need to index */
				`time` BIGINT NOT NULL,
				 INDEX(`time`), 
			  	`ip` BIGINT NOT NULL,
				 INDEX(`ip`),
				`content` json 
			)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci'
	);
	execute_sqls($sqls);
}

function create_table_query_log()
{
	$sqls = array(
//		'DROP `ls_query_log`' => 'DROP TABLE IF EXISTS `ls_query_log`',
		'CREATE `ls_query_log`' =>
			'CREATE TABLE `ls_query_log`(
		  		`id` BIGINT AUTO_INCREMENT,
	  			 PRIMARY KEY(`id`),
				`token` VARCHAR(15) NOT NULL,
				 INDEX(`token`),
				`ip` BIGINT NOT NULL,
				`time` BIGINT NOT NULL,
				 INDEX(`time`),
				`referer` VARCHAR(256),
				`ua` VARCHAR(256),
				`lang` VARCHAR(64)
			)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci'
	);
	execute_sqls($sqls);
}