<?php include "../functions/db.php";
include "../layout/header.php"; ?>
<div class="log-box">
    <div class="loginbox">
        <form method="POST" action="../functions/user.php">
        <h2>REGISTER NOW</h2>
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" id="username"  required>
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" id="email"  required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" id="password"  required>
            </div>
            <div class="form-group">
                <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password" id="confirmPassword"  required>
            </div>
            <div class="form-group">
                <input type="submit" value="ENTER" class="btn btn-primary">
                <input type="hidden" name="action" value="register">
            </div>
            <div class="button-log">
                <p>Already have an account? <a href="login.php">Sign in</a></p>
            </div>
        </form>
    </div>
</div>