<?php
require_once "includes/connection.php";
var_dump($_GET);

$id = $_GET['id'];
$etat = $_GET['etat'];


$stmt = $pdo->prepare('UPDATE commands SET valide = ? WHERE id = ?');
$stmt->execute([$etat, $id]);
header('Location: commands.php?id='.$id);
?>