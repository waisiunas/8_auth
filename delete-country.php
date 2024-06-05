<?php
require_once "./partials/if-authenticated.php";
require_once "./partials/connection.php";

$id = htmlspecialchars($_GET['id']);

$sql = "DELETE FROM `countries` WHERE `id` = $id;";
if ($conn->query($sql)) {
    header('location: ./');
} else {
    die("Failed to delete!");
}
