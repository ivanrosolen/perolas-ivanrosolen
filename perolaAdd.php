<?php
header('Content-type: text/html; charset=utf-8');

$dbh = new PDO('mysql:host=localhost;dbname=dbname;charset=utf8', 'user', 'pwd');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->exec("set names utf8");

$perola = filter_var($_POST['perola'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$nome   = filter_var($_POST['nome'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

try {
	$sth = $dbh->prepare('INSERT INTO perolas (perola,nome) VALUES (:perola,:nome)');
	$sth->bindParam(':perola', $perola, PDO::PARAM_STR );
	$sth->bindParam(':nome', $nome, PDO::PARAM_STR );
	$sth->execute();
} catch ( PDOException $e ) {
	error_log( $e->getMessage( ) );
}