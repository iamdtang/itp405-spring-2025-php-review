<?php

$pdo = new PDO("sqlite:chinook.db");
$statement = $pdo->prepare('SELECT * FROM invoices');
$statement->execute();
$tracks = $statement->fetchAll();

echo count($tracks);
