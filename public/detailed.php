<?php
    require_once("../modules/news/NewsManager.php");
    $newsManager = new NewsManager();

    if (isset($_GET["no"]) && !isset($_GET["title"])) {
        $new = $newsManager->getNewByNo($_GET["no"]);
    } else if (!isset($_GET["no"]) && isset($_GET["title"])) {
        $new = $newsManager->getNewByTitle($_GET["title"]);
    }
?>

<html>
     <head>
         <title>Scrapping Web App</title>
         <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
         <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
         <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
         <script src="/js/app.js"></script>
         <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
         <link rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
         <link rel='stylesheet' type='text/css' href='/css/styles.css'>
     </head>

     <body>
        <div class="jumbotron">
            <h1><? print $new->getTitle() ?></h1>
            <p><? print $new->getContent() ?></p>
            <p><b>Date: </b> <? print $new->getDate() ?> </p>
            <br><br>
            <p><b>Source: </b> <? print $new->getId() ?> </p><br>
            <p><b>Author: </b> <? print $new->getAuthor() ?> </p>
        </div>
     </body>
</html>