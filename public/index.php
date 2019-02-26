<?php
    require_once("../modules/news/NewsManager.php");
    $newsManager = new NewsManager();

    $query = $_GET["source"];
    if ($query == "") {
        $newsArray = $newsManager->getAllNews();
        $currentSource = 'general';
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
        <link rel='stylesheet' type='text/css' href='/css/styles.css'>
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
                    <a class="navbar-brand customNavBrand" href="index.php">Newscraping</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <form class="navbar-form navbar-right">
                        <select id="sources" class="form-control">
                            <option value="null">Choose a source</option>
                            <option value="">General</option>
                            <option value="nytimes">New York Times</option>
                            <option value="reforma">El reforma</option>
                            <option value="debate">Debate</option>
                        </select>
                        <div class="form-group">
                        <input id="searchInput" type="text" class="form-control" placeholder="Type here...">
                        </div>
                        <button type="submit" id="searchButton" class="btn btn-info">Search</button>
                    </form>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="container">
            <div align="center"><h1 id="currentSource"><?print $currentSource?>: <?print $quantity?></h1></div>
            <div align="center"><a id="downloadExcel" class="btn btn-danger" href="excel-generator.php?source=<?print $currentSource?>" target="_blank">Download excel</a></div><br>
            <div align="left">
                <h4>Filter by date:</h4>
                <input id="filterInput" type="date" name="filter">
                <button type="submit" id="filterButton" class="btn btn-default">Filter</button>
            </div><br>
            <div id="newsContainer" class="row">
                <?
                    foreach((array) $newsArray as $new) {
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
                ?>
            </div>
        </div>

        <script src="/js/app.js"></script>
    </body>
</html>