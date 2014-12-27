<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Project Sphere</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link href="css/3-col-portfolio.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><i class="glyphicon glyphicon-record"></i> Project Sphere</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
                 <div style="float:right;">
                   <button type="button" class="btn btn-default navbar-btn" style="background-color:#337AB7;color:white;" onclick="window.location.href='../login/logout.php'">Log Out</button>
                </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

    <?php
        $projectID = $_GET['id'];
        require_once (__DIR__."/../database/database.php");
        $project = getProjectByID($projectID);
		
			echo '
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">' . $project['project_name'] . '
							<!--<small>project programming</small>-->
						</h1>
					</div>
				</div>
			
			';
			echo '<div clas="row">';
				echo '<div class="col-md-4 portfolio-item">
						<a href="project.php?id='.$project['id'].'">';

        $photos = split('<',$project['photos']);
        $photo_url = "";
        foreach ($photos as $photo)  {
        	$photo_url= $photo;
        	//$photo_url=getPhotoUrl($photo);
        	if(!empty($photo_url)) {
        		break;
        	}
        }
        echo '<img class="img-responsive" src="'.$photo_url.'" alt="">';
        echo '</a><p>'.substr($project['description'], 0, 30).'</p></div>';
		
		echo '</div>';
        ?>
        <!-- /.row -->

        

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; David Mayo & Albert Shaw 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>


</body>

</html>
