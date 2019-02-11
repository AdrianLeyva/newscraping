<?php
    require_once("../modules/news/NewsManager.php");
    $newsManager = new NewsManager();
    
    $query = $_GET["source"];
    if ($query == "") {
        $newsArray = $newsManager->getAllNews();
        $currentSource = 'General';
    } else {
        $newsArray = $newsManager->getNewsBySource($query);
        $currentSource = $query;
    }
    $quantity = count($newsArray);
?>

<html>
    <head>
        <title>Scrapping Web App</title>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
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
                        <select id="sources">
                            <option value="null">Choose a source</option>
                            <option value="">General</option>
                            <option value="nytimes">New York Times</option>
                            <option value="reforma">El reforma</option>
                            <option value="debate">Debate</option>
                        </select>
                        <div class="form-group">
                        <input id="searchInput" type="text" class="form-control" placeholder="Type here...">
                        </div>
                        <button type="submit" id="searchButton" class="btn btn-default">Search</button>
                    </form>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="container">
            <div align="center"><h1 id="currentSource"><?print $currentSource?>: <?print $quantity?></h1></div>
            <div id="newsContainer" class="row">
                <?
                    foreach((array) $newsArray as $new) {
                        $no = $new->getNo();
                        $title = $new->getTitle();
                        $content = $new->getContent();
                        print "
                        <div class='col-sm-6 col-md-4''>
                            <div class='thumbnail'>
                                <img src='...' alt='...'>
                                <div class='caption'>
                                    <h3>$title</h3>
                                    <p>$content</p>
                                    <p><a href='detailed.php?no=$no' class='btn btn-primary' target='_blank' role='button'>Read more</a></p>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                ?>
            </div>
        </div>

        <script>
            var titles = [];
            $(document).ready(function() {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        titles = JSON.parse(this.responseText);
                        $('#searchInput').autocomplete({
                            source: titles
                        });
                    }
                };
                xmlhttp.open("GET", "requests.php", true);
                xmlhttp.send();
            });

            $('#sources').change(function() {
                var value = $('#sources').val();
                window.location.href="index.php?source=" + value;
            });

            $('#searchButton').click(function() {
                var value = $('#searchInput').val();
                window.open("detailed.php?title=" + value);
            });
        </script>
    </body>
</html>