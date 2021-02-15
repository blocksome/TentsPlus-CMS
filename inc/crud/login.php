<?php

include("db-login.php");

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); // Test if connection occurred.

if (mysqli_connect_errno()) {

    die("Database connection failed: " .
        " mysqli_connect_error()" .
        "(" . mysqli_connect_errno() . ")");
} else {

    $username = $_GET["username"];
    $password = $_GET["password"];

    $standardRegex = "/^[a-zA-Z0-9!._]+$/";

    //Empty fields
    if ($username == ("" || null) || $password == ("" || null)) {
        $statusMsg = "Your Username and/or Password is/are not filled in. Please try again.";
    }

    //Invalid fields
    else if (!preg_match($standardRegex, $username) || !preg_match($standardRegex, $password)) {
        $statusMsg = "Your Username and/or Password contain(s) unsupported characters. Please try again.";
    }

    //Check database for matching credentials
    else {
        $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); // Test if connection occurred.

        if (mysqli_connect_errno()) {

            die("Database connection failed: " .
                " mysqli_connect_error()" .
                "(" . mysqli_connect_errno() . ")");
        } else {
            //Run MYSQL request upon successful connection
            $sql = "SELECT * ";
            $sql .= "FROM account ";
            $sql .= "ORDER BY acc_id;";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {

                //Compare data
                while ($row = mysqli_fetch_assoc($result)) {
                    //Matched Username
                    if($row["acc_user"] == $username){

                        if($row["acc_pass"] == $password){
                            if($row["acc_type"] != "Admin"){
                                $statusMsg = "Your account does not have the security clearance to access the CMS.";
                            }
                            else{
                                $statusMsg = "success";
                            }
                            
                            break;
                        }

                        else{
                            $statusMsg = "Your Password is incorrect.";

                            break;
                        }
                    }

                    else{
                        $statusMsg = "Your Username doesn't exist in our records.";
                    }


                }
                ;
            } else if ($con->error) {
                $statusMsg = "Query failed: %s\n, $con->error";
            }
        }

        
    }

    echo $statusMsg;
    
    $con->close();
}
