<?php 
include "../functions/db.php";
$txt = $_GET['txt'];
$id = $userinfo['id'];
$if = $db->query("SELECT id FROM `likes` WHERE post_id ='$txt' AND user_id = '$id'");
$if = $if->fetch_array();
if($if != "")
{
    $db->query("DELETE FROM `likes` WHERE post_id=$txt AND user_id=$id"); 
    
}
else
{
    $db->query("INSERT INTO `likes` (`post_id`, `user_id`) VALUES ('$txt', '$id')");
    
}
$all = $db->query("SELECT COUNT(1) FROM likes WHERE post_id=$txt");
$all = $all->fetch_array(); 
$db->query("UPDATE `images` SET likes= $all[0] WHERE id=$txt");
echo $_GET['txt'];
 ?>