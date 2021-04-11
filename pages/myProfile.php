<?php
include "../functions/db.php";
include "../layout/header.php";
if (!$loggedIn){
    header("Location: login.php");
}
$id = $userinfo['id'];
$all = $db->query("SELECT COUNT(1) FROM likes WHERE user_id=$id");
$all = $all->fetch_array(); 
$all_images_likes = $db->query("SELECT id FROM images WHERE user_id=$id");
$num = 0;
foreach($all_images_likes as $likes)
{
   
    $likes = $likes['id'];
    $if = $db->query("SELECT COUNT(1) FROM likes WHERE post_id='$likes'");
    $if = $if->fetch_array(); 
    $num = $num + $if[0];
}
$all_images_likes = $all_images_likes->fetch_array(); 
$all_posts = $db->query("SELECT COUNT(1) FROM images WHERE user_id=$id");
$all_posts = $all_posts->fetch_array(); 
?>
<div class="log-box">
    <div class="profile_menu">
        <form method="POST">
        <h2>YOUR PROFILE</h2>
            <div class="button-log">
                    <p>Your nickname: <?php echo $userinfo['username']; ?> </p>
            </div>
            <div class="button-log">
                    <p>Your email: <?php echo $userinfo['email']; ?> </p>
            </div>
            <div class="button-log">
                    <p>Posts you've liked: <?php echo $all[0]; ?> </p>
            </div>
            <div class="button-log">
                    <p>Your posts' likes: <?php echo $num; ?> </p>
            </div>
            <div class="button-log">
                    <p>Your posts: <?php echo $all_posts[0]; ?> </p>
            </div>
        </form>
    </div>
</div>