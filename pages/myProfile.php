<?php
include "../functions/db.php";
include "../layout/header.php";
if (!$loggedIn){
    header("Location: login.php");
}
