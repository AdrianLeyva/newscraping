<?php
    $currentSource = 'General';
    $newsArray = array(
        0 => array("title" => "Noticia 1", "content" => "This is the mock content"),
        1 => array("title" => "Noticia 2", "content" => "This is the mock content"),
        2 => array("title" => "Noticia 3", "content" => "This is the mock content")
    )
?>

<html>
    <head>
        <title>Scrapping Web App</title>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="js/app.js"></script>
        <link rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
        <link rel='stylesheet' type='text/css' href='css/styles.css'>
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
                        <select>
                            <option value="">Choose a source</option>
                            <option value="">Option one</option>
                            <option value="">Option two</option>
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
            <div align="center"><h1><?print $currentSource?></h1></div>
            <div class="row">
                <?
                    foreach($newsArray as $new) {
                        $title = $new['title'];
                        $content = $new['content'];
                        print "
                        <div class='col-sm-6 col-md-4'>
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
    </body>
</html>