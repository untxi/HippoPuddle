<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="image/hippoPuddle_icon.ico" />
    <title>HippoPuddle</title>
   
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/half-slider.css" rel="stylesheet">

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" align="middle">
                <a class="navbar-brand" href="index.php"><img src="image/hippoPuddle_icon.ico.png" width="35" height="35"></a>
                <a class="navbar-brand" href="index.php">HippoPuddle</a>

                <input type=hidden name=ie value="UTF-8"/>
                <input type=hidden name=oe value="UTF-8" />
                                
                <INPUT TYPE=text id="s" name="q" value="" size="50"/>
                
                           
                    <button type="button" class="btn btn-default" style="color=black">Search</button>
                

            </div>
        </div>
        <!-- /.container -->
    </nav>

    <!-- Half Page Image Background Carousel Header -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="carousel-caption">
                    <img src="http://lorempixel.com/g/800/400/"/>
                </div>
            </div>
            <div class="item">
                <div class="carousel-caption">
                    <img src="http://lorempixel.com/g/800/400/"/>
                </div>
            </div>
            <div class="item">
                <div class="carousel-caption">
                    <img src="http://lorempixel.com/g/800/400/"/>
                </div>
            </div>
            <div class="item">
                <div class="carousel-caption">
                    <img src="image/hippoPuddle_logo.png"/>
                </div>
            </div>
        </div>

    </header>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12" align="center">
                <h1>Lookup what you want to sing</h1>
            </div>
        </div>

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyleft ~ Samantha Arburola</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
