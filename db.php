<?php
$con = mysqli_connect("localhost", "root", "", "dbtodo") or die(mysqli_connect_error());

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>