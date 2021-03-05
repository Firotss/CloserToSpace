<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CloserToSpace</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="navbar">
    <div class="container">
        <div class="logo_div" style="background-image:url(../images/logo.png);">
            <a href= "../pages/index"><img src="../images/logo.png" draggable="false" alt="The art of painting logo" class="logo"></a>
        </div>
        <div class="navbar_links">
        <form method="GET" action="../pages/index">
        <input name="search" id="search" placeholder="Search..." autocomplete="off"></input>
        </form>
            <ul class="menu">
                <li><a href="../pages/index">Home</a></li>
                <li><a href="../pages/addArticle">Add article</a></li>
                <li><a href="../pages/myArticles">My articles</picture></picture></a></li>
                <?php if ($loggedIn) { ?>
                    <li><a href="../pages/myProfile">My profile</a></li>
                    <li><a href="../functions/logout">Logout</a></li>
                <?php } else { ?>
                    <li><a href="../pages/login">Login/Register</a></li>
                <?php } ?>
            </ul>                               
        </div>                            
    </div>
</div>