<?php

$connect = mysqli_connect("localhost:3307", "root", "Muskan#123", "votings");

if ($connect) {
    echo "Connected!";
} else {
    echo "Not Connected!";
}

?>
