<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Project Sphere</title>
    <link rel="shortcut icon" href="../login/images/favicon.ico" />
    
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link href="css/3-col-portfolio.css" rel="stylesheet">

    <!--lightbox-->
    <link href="css/lightbox.css" rel="stylesheet" />

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
                <div style="float:right;">

                <?php
                require "../login/config/config.php";
                require "../login/checklogin.php";
                if(isset($_COOKIE["upload_user"])&&isset($_COOKIE["user_code"])&&checklogin ($db_server, $db_username, $db_password, $db_database, $_COOKIE["upload_user"], $_COOKIE["user_code"])==true) {
                   echo '<button type="button" class="btn btn-primary navbar-btn" onclick="window.location.href=\'../fileupload/submitProject.php\'"><i class="glyphicon glyphicon-plus"></i> Submit Project</button>
                        <button type="button" class="btn btn-primary navbar-btn" onclick="window.location.href=\'../login/logout.php\'"><i class="glyphicon glyphicon-log-out"></i> Log Out</button>';

                }
                else {
                    echo '<button type="button" class="btn btn-primary navbar-btn" onclick="window.location.href=\'../login/login.php\'"><i class="glyphicon glyphicon-log-in"></i> Log in</button>';
                }
                ?> 
                
                </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container" >
        <div class="project-container">
    <?php
        $projectID = $_GET['id'];
        require_once (__DIR__."/../database/database.php");
        $project = getProjectByID($projectID);
		
			echo '
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header" style="margin-bottom:0px;">' . $project['project_name'] . '
							<small>'.$project['category'].', '.$project['grade'].'th</small>
						</h1>
					</div>

			';
		
				echo '<div class="col-lg-12">';
        //echo '<p>''</p>';
        echo '<h3>Authors</h3>David Mayo and Albert Shaw';
        echo '<h3>Project Description</h3>';
        echo '<p>'.$project['description'].'</p>';
        echo '<h3>Sources</h3>';
        echo '<p>'.$project['sources'].'</p>';
        echo '<hr />';
        echo '<h3>Pictures</h3>';
        $photos = split('<',$project['photos']);
        $photo_url = "";
        foreach ($photos as $photo){
            if(!empty($photo)){
                $photo_url= $photo;
                echo '<div class="col-lg-6" style="height:400px;">';
                echo '<a data-lightbox="project-images" href="'.$photo_url.'"><img class="img-responsive" src="'.$photo_url.'" alt="" style="max-height:400px;max-width:500px;padding:10px 10px 10px 10px;"></a>';
                echo '</div>';
            }
        }
		echo '</div></div>';
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
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!--lightbox-->
    <script src="js/lightbox.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>


</body>

</html>
