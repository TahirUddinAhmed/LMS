<?php

 define("SERVER_NAME", "localhost");
 define("DB_USER", 'root');
 define("DB_PASS", '');
 define("DB_NAME", 'lms');

 $conn = mysqli_connect(SERVER_NAME, DB_USER, DB_PASS, DB_NAME);

 if(!$conn) {
    die("Connection failed due to: " . mysqli_connect_error());
 } else {
    echo "Yes we are good to go";
 }