<?php
try {
	$dbh = new PDO('mysql:dbname=games;host=localhost', 'root', 'root');
} catch (PDOException $e) {
	die($e->getMessage());
}
session_start();

if (isset($_SESSION['nick'])){
    $sql = "SELECT * FROM `users` WHERE `nick` = ':nick' LIMIT 1";
    $ku = $dbh->prepare($sql);
    $ku->execute([
        'nick' => $_SESSION['nick']]
    );
}
