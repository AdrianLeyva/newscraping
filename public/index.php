<?php
    require_once("../modules/news/NewsManager.php");
    $newsManager = new NewsManager();
    $currentSource = 'General';
    $newsArray = $newsManager->getNewsBySource("nytimes");
    $quantity = count($newsArray);
?>

<html>
    <head>
        <title>Scrapping Web App</title>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="/js/app.js"></script>
        <link rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
        <link rel='stylesheet' type='text/css' href='/Users/adrianleyvasanchez/Documents/Development/VIACCE/newscraping/public/css/styles.css'>
    </head>
    <body>
        <nav class="navbar navbar-default customNav">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Newscraping</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <form class="navbar-form navbar-right">
                        <select id="sources" onchange="onChangeSources()">
                            <option value="general">General</option>
                            <option value="nytimes">New York Times</option>
                            <option value="universal">The universal</option>
                        </select>
                        <div class="form-group">
                        <input type="text" class="form-control" placeholder="Type here...">
                        </div>
                        <button type="submit" class="btn btn-default">Search</button>
                    </form>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="container">
            <div align="center"><h1><?print $currentSource?>: <?print $quantity?></h1></div>
            <div class="row">
                <?
                    foreach((array) $newsArray as $new) {
                        $title = $new->getTitle();
                        $content = $new->getContent();
                        print "
                        <div class='col-sm-6 col-md-4''>
                            <div class='thumbnail'>
                                <img src='...' alt='...'>
                                <div class='caption'>
                                    <h3>$title</h3>
                                    <p>$content</p>
                                    <p><a href='#' class='btn btn-primary' role='button'>Read more</a></p>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                ?>
            </div>
        </div>
    
        <script>
            function onChangeSources() {
                selected = document.getElementById("sources").value;
                alert(selected);
            }
        </script>
    </body>
</html>