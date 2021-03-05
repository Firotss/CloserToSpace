<?php
include "../functions/db.php";
include "../layout/header.php";
if (!$loggedIn){
    header("Location: login.php");
}?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css"/>
</head>
<body>
<?php
if(isset($_GET['delete'])){
    $ids = $_GET['id'];
    $db->query("DELETE FROM images WHERE id = '$ids'");
}
$query = $db->query("SELECT * FROM images ORDER BY 'user_id' DESC");
$user_id = $userinfo['id'];
$a = $db->query("SELECT COUNT(0) FROM images WHERE user_id = $user_id");
$if = $a->fetch_array();
if ($if[0] > 0){ ?> 
    <div class="table">
        <div class="first">
            <div class="cell-1">
            Picture
            </div>
            <div class="cell-2">
            Name
            </div>
            <div class="cell-4">
            Description
            </div>
            <div class="cell-6">
            Actions
            </div>
        </div>
    </div>
    <?php while ($row = $query->fetch_assoc()){
        if ($row['user_id'] == $userinfo["id"]){
            $show_img = base64_encode($row['img']);?>
            <div class="table">
            <div class="second">
                <div class="cell-img" data-title="Picture" style="background-image: url('data:image/jpeg;base64, <?=$show_img ?>');"></div>
                <div class="cell" data-title="Name"><?php echo($row['title']);?></div>
                <div class="cell-di" data-title="Description"><?php echo($row['description']);?></div>
                <div class="cell" data-title="Delete/Show"><a  href="?&delete=&id=<?php echo($row['id']);?>"><input class="button" type="submit" value="Delete"></a></div>
            </div>
<?php } } } else{header("Location: addArticle");} ?></div></body>
    