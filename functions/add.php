<?php
include "db.php";
if (!$loggedIn){
    header("Location: ../pages/login.php");
}

$title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
$description = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);
$user_id = $userinfo["id"];

if (isset($_POST['upload'])){
	$img_type = substr($_FILES['img_upload']['type'], 0, 5);
	$img_size = 2*1024*1024;
	if (!empty($_FILES['img_upload']['tmp_name']) and $img_type === 'image' and $_FILES['img_upload']['size'] <= $img_size){ 
		$image_info = getimagesize($_FILES['img_upload']['tmp_name']);
		$format = strtolower(substr($image_info['mime'], strpos($image_info['mime'], '/') + 1));
		$im_cr_func = "imagecreatefrom" . $format;
		$im = $im_cr_func($_FILES['img_upload']['tmp_name']);
		$w = imagesx($im) - 20;
		ob_start();
		imagepng($im);
		$img = ob_get_contents();
		ob_end_clean();
		$img = addslashes($img);
		$db->query("INSERT INTO `images` (`user_id`, `img`,`title`,`params`,`description`, `likes`) VALUES ('$user_id' ,'$img','$title', 1,'$description', 0)");
		if ($db->error) {
			printf("Errormessage: %s\n", $db->error);
		} } }
		header("Location: ../pages/index");
?>