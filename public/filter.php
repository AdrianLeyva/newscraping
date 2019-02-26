<?php
require_once("../modules/news/NewsManager.php");
$newsManager = new NewsManager();
$newsArray = $newsManager->getAllNews();
$dateByFilter = $_GET["date"];
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
        <div class="row">
          <?
          foreach((array) $newsArray as $new) {
           $newDate = preg_split("/\,/", $new->getDate())[0];
           if (strcmp($newDate, $dateByFilter) == 0) {
            $no = $new->getNo();
            $title = $new->getTitle();
            $content = $new->getContent();
            $author = $new->getAuthor();
            $date = $new->getDate();
            print "
            <div class='col-sm-6 col-md-4''>
                <div class='thumbnail customThumb'>
                    <div  align='center' class='caption'>
                        <h3>$title</h3>
                        <p>$content</p>
                        <p><b>Author:</b><br>$author</p>
                        <p><b>Date:</b><br>$date</p>
                        <p><a href='detailed.php?no=$no' class='btn btn-info' target='_blank' role='button'>Read more</a></p>
                    </div>
                </div>
            </div>
            ";
           }
          }

          ?>
        </div>
     </body>
</html>


