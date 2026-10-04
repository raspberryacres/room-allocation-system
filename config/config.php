<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "room_allocation_system"
);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>