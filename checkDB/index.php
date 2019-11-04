<?php include '../inc/dbconnection.php';

echo "Hello World";
$stmt = $link->prepare("INSERT INTO khata (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password);

$name = "John";
$email = "john@example.com";
$password = "Hello World";
$stmt->execute();
?>