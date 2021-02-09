<?php
//Connect to database

//School db login
/*
$dbhost = "localhost";
$dbuser = "amphibis_joses";
$dbpass = "miGLzU*S.xJV";
$dbname = "amphibis_joses";
*/

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "tents_plus_database";

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); // Test if connection occurred.

if (mysqli_connect_errno()) {

    die("Database connection failed: " .
        " mysqli_connect_error()" .
        "(" . mysqli_connect_errno() . ")");
} else {
    //Display different settings for different users
}?>