<?php
include "db.php";
if (isset($_POST["action"])) {
    if ($_POST["action"] == "login") {
        $userData = array(
            "username" => $_POST["username"],
            "password" => $_POST["password"]
        );
        if (userExistsByUsername($userData["username"])) {
            $databaseUser = getUserByUsername($userData["username"]);
            if (password_verify($userData["password"], $databaseUser["password"])) {
                $userKey = md5(uniqid());
                setUserKey($databaseUser["id"], $userKey);
   
                setcookie("user_key", $userKey, time() + (86400*30), "/");

                header("Location: ../pages/myProfile.php");
            } else {
                echo $databaseUser['password'];
                echo $userData['password'];
            } }
        } else if($_POST["action"] == "register") {
            $userData = array(
                "username" => $_POST["username"],
                "email" => $_POST["email"],
                "password" => $_POST["password"],
                "confirmPassword" => $_POST["confirmPassword"]
            );
            
            if(validateRegister($userData)) {
                if(!userExistsByUsername($userData["username"])) {
                    if(addUser($userData)) {
                        $databaseUser = getUserByUsername($userData["username"]);
                        $userKey = md5(uniqid());
                        setUserKey($databaseUser["id"], $userKey);
       
                        setcookie("user_key", $userKey, time() + (86400*30), "/");
    
                        header("Location: ../pages/myProfile.php");
                    } else {
                        echo "There was problem with adding the user to the database.";
                    }
    
                } else {
                    echo "The username is already taken.";
                }
            }
        }
} else {
    die("Invalid request.");
}