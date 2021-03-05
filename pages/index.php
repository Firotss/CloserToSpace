<?php
include "../functions/db.php";
include "../layout/header.php";
?>
<?php
$feeds = array(
    "https://www.nasa.gov/rss/dyn/breaking_news.rss",
    "https://www.space.com/feeds/all"
);
$entries = array();
            foreach($feeds as $feed) {
                $xml = simplexml_load_file($feed);
                $entries = array_merge($entries, $xml->xpath("//item"));
            }
            foreach($entries as $entry){
                $title = $entry->title;
                $query = "SELECT COUNT(1) FROM images WHERE title=$title";
                $all_search = $db->query($query);
                $all_search = $all_search->fetch_array();
                    if($all_search[0] == 0)
                {
                $img = $entry->enclosure["url"];
                $format = $entry->enclosure["type"];
                $format = explode("/", $format);
                $im_cr_func = "imagecreatefrom" .  $format[1];
                $im = $im_cr_func($img);
                ob_start();
                imagepng($im);
                $img = ob_get_contents();
                ob_end_clean();
                $img = addslashes($img);
                $description = $entry->description;
                $db->query("INSERT INTO `images` (`user_id`, `img`,`title`,`params`,`description`, `likes`) VALUES (0 ,'$img','$title', 2,'$description', 0)");
                }
            }
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<script> load() </script>
<div class="log-box">
    <div class="container">
        <?php
        if(isset($_GET['search']))
        {
            $search = $_GET['search'];
            $search = explode(" ", $search);

            foreach($search as $word){
                $sql[] = 'description LIKE "%'.$word.'%"';
            }
            $query = "SELECT COUNT(1) FROM images WHERE ".implode(" AND ", $sql);
            $all_search = $db->query($query);
            $all_search = $all_search->fetch_array();
            if($all_search[0] == 0)
            {
                ?>
                <div class="find_menu"> 
                    <h2 style="color: white">SORRY LINK, I CANT GIVE U CREDIT, RETURN WHEN YOU ARE LITTLE MM... RICHER!</h2>
                </div> 
                 <?php
                $query = "SELECT * FROM images ORDER BY likes DESC LIMIT 50";
            }
            else{
            $query = "SELECT * FROM images WHERE ".implode(" AND ", $sql)." ORDER BY likes DESC LIMIT 50";  
            }
        }
        else
        {
            $query = "SELECT * FROM images ORDER BY likes DESC LIMIT 50";
        }
        $a = $db->query($query); 
        ?>
        
        <div class="box-area">
            <?php
            while($if = $a->fetch_array()){
                $show_img = base64_encode($if['img']);
                ?>
                
                <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                    <div class="flipper">
                        <div class="single-box front">
                            <div class="img-area" style="background-image: url('data:image/jpeg;base64, <?=$show_img ?>');"></div>
                            <div class="img-text">
                                <span class="header-text"><strong><?php echo($if['title']);?></strong></span>
                                <p><?php 
                                if($if['params'] == 1){
                                    echo "User article";
                                } else{
                                    echo "Bot article"; }
                                $id = $if['id'];
                                $all = $db->query("SELECT COUNT(1) FROM likes WHERE post_id=$id");
                                $all = $all->fetch_array(); 
                                ?></p>
                                <h4 class="likes" id="text <?php echo $id;?>" num="<?php echo($all[0]);?>"><?php echo($all[0]);?> likes</h4>
                            </div>
                        </div>
                        <div class="single-box back" id="myDIV">
                                <h3 style="font-weight:bold"><?php echo($if['title']); ?> </h3><p>&nbsp;</p><p> <?php echo($if['description']);?> </p>
                                <?php if(isset($userinfo['id'])){ 
                                 $txt = $if['id'];
                                 $id = $userinfo['id'];
                                 $if = $db->query("SELECT id FROM `likes` WHERE post_id ='$txt' AND user_id = '$id'");
                                 $if = $if->fetch_array();
                                    if($if != ""){?>
                                <div class="like <?php echo $txt;?>" id="<?php echo $txt;?>" style="background-image:url(../images/full-heart.png);" onClick='imgsrc("<?php echo $txt;?>"); changeColor(1, "<?php echo $txt;?>");'></div>
                                <?php }else{ ?> 
                                <div class="like <?php echo $txt;?>" id="<?php echo $txt;?>" style="background-image:url(../images/white-heart.png);" onClick='imgsrc("<?php echo $txt;?>"); changeColor(2, "<?php echo $txt;?>");'></div> 
                                <?php
                                }} ?> 
                        </div>
                        <script>
                        function changeColor(num, id) {
                            var y = "text "+id;
                            var x = document.getElementById(id); 
                            const text = document.getElementById(y).innerHTML;

                            var addDiv = document.createElement('div');
                            addDiv.classList.add('pulse');
                            console.log(addDiv)
                            x.appendChild(addDiv);

                        if(x.style.backgroundImage == 'url("../images/white-heart.png")'){
                            x.style.backgroundImage = 'url(../images/full-heart.png)';
                            var z = Number(text[0])+1;
                        }
                        else
                        {
                            var z = Number(text[0])-1;
                            x.style.backgroundImage = 'url(../images/white-heart.png)';
                        }
                        document.getElementById(y).innerHTML = z + ' likes';
                        }
                        </script>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript" src="js.js"></script>
<?php include "../layout/footer.php"; ?>