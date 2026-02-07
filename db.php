<?php
$conn = new mysqli("localhost", "root", "", "cat_adoption");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
