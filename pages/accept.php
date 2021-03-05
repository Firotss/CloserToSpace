<?php
include "../functions/db.php";
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
