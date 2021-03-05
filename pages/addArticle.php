<?php
include "../functions/db.php";
include "../layout/header.php";
if (!$loggedIn){
    header("Location: login.php"); 
}
?>
<form action="../functions/add.php" method="post" enctype="multipart/form-data">
    <div class="log-box">
        <div class="loginbox">
        <h2>UPLOAD NOW</h2>
            <p><input type="text" name="title" maxlength="100" class="input-title" placeholder="Your title goes here" required></p>
            </p>
            <input type="text" name="description" maxlength="350" class="input-description" placeholder="Description mustn't be over 400 characters" required></textarea>
            <p>Image:</p>
            <input type="file" name="img_upload" required>
            <input type="submit" name="upload" value="Upload">
        </div>
    </div>
</form>