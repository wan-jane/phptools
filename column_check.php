<?php
$pdo = new PDO("mysql:host=127.0.0.1;dbname=test;charset=utf8;",'root','root');
$column = 'delete_time';
$sql = 'show tables';
$tables = [];
$st = $pdo->query($sql);
$tables = $st->fetchAll(PDO::FETCH_NUM);

$tables = array_column($tables, 0);
$dt = [];
$dt_sql = [];
foreach($tables as $table) {
    $sql = sprintf("Describe %s `%s`", $table, $column);
    $st = $pdo->query($sql);
    $result = $st->fetch();
    if ($result == false) {
        echo $table . " 没有指定字段\n";
        $dt[] = $table;
        $dt_sql[] = sprintf("ALTER TABLE `%s` ADD COLUMN `%s` BIGINT(20) NULL DEFAULT NULL COMMENT '1231';", $table, $column);
    }
}
print_r($dt);
print_r($dt_sql);
