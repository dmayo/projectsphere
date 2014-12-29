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

                <?php
                require "../login/config/config.php";
                require "../login/checklogin.php";
                if(isset($_COOKIE["upload_user"])&&isset($_COOKIE["user_code"])&&checklogin ($db_server, $db_username, $db_password, $db_database, $_COOKIE["upload_user"], $_COOKIE["user_code"])==true) {
                   echo '<button type="button" class="btn btn-default navbar-btn" style="background-color:#337AB7;color:white;" onclick="window.location.href=\'../fileupload/submitProject.php\'"><i class="glyphicon glyphicon-plus"></i> Submit Project</button>
                        <button type="button" class="btn btn-default navbar-btn" style="background-color:#337AB7;color:white;" onclick="window.location.href=\'../login/logout.php\'">Log Out</button>';

                }
                else {
                    echo '<button type="button" class="btn btn-default navbar-btn" style="background-color:#337AB7;color:white;" onclick="window.location.href=\'../login/login.php\'">Log in</button>';
                }
                ?> 

                </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Project Gallery
                    <small>project programming</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
			<?php
				require_once (__DIR__."/../database/database.php");
				$projects = getProjectsBrief();
				foreach ($projects as $project) {
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
                    if($photo_url!=""){
					   echo '<div class="image-slot-height"><div class="image-slot"><img class="img-responsive" src="'.$photo_url.'" alt=""></div></div>';
                    }
                    else{
                       echo '<div class="image-slot-default">No Image Available</div>';
                    }
					echo '</a>
							<h3>
								<a href="project.php?id='.$project['id'].'">';
					
					echo $project['project_name'];
					echo '</a></h3>
								<p>'.substr($project['description'], 0, 318);
                                if(strlen($project['description'])>318){echo ' ...';}
                                echo '</p></div>';
				}
				
			?>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Pagination -->
        <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li>
                        <a href="#">&laquo;</a>
                    </li>
                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
                    <li>
                        <a href="#">&raquo;</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.row -->

        <hr>

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
