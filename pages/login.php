<?php
include "../functions/db.php";
include "../layout/header.php";
?>
<div class="log-box">
    <div class="loginbox">
        <form method="POST" action="../functions/user.php">
        <h2>LOGIN</h2>
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" id="username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" id="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="ENTER" class="btn btn-primary">
                <input type="hidden" name="action" value="login">
            </div>
            <div class="button-log">
                <p>You don't have an account? <a href="register">Sign up</a></p>
            </div>
        </form>
    </div>
</div>
