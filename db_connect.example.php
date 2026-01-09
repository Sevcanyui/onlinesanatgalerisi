<?php
$host = "localhost";
$db   = "art_gallery";
$user = "KULLANICI_ADI";
$pass = "SIFRE";

$pdo = new PDO(
    "mysql:host=$host;dbname=$db;charset=utf8",
    $user,
    $pass
);
