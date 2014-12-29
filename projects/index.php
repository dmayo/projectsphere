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
    <div class="container">

        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-6">
                <h1 class="page-header">Project Gallery</h1>
            </div>
            <div class="col-lg-6" style="padding-top:50px;padding-right:70px;">
                <div class="dropdown" style="float:right;">
                  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                    <?php
                    if(!isset($_GET['grade'])){
                        echo 'All Grades';
                    }
                    else{
                        echo $_GET['grade'];
                        $gradeDivision=$_GET['grade'];
                    }
                    if(isset($_GET['category'])){
                        $category=$_GET['category'];
                    }
                    ?>

                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?grade=All Grades<?php if(isset($category)){echo '&category='.$category;} ?>">All Grades</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?grade=9-10<?php if(isset($category)){echo '&category='.$category;} ?>">9-10</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?grade=11-12<?php if(isset($category)){echo '&category='.$category;} ?>">11-12</a></li>
                  </ul>
                </div>
                <div class="dropdown" style="float:right;padding-right:10px;">
                  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                    <?php
                    if(!isset($_GET['category'])){
                        echo 'All Categories';
                    }
                    else{
                        echo $_GET['category'];
                    }
                    ?>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?category=All Categories<?php if(isset($gradeDivision)){echo '&grade='.$gradeDivision;} ?>">All Categories</option></a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?category=3D Modeling<?php if(isset($gradeDivision)){echo '&grade='.$gradeDivision;} ?>">3D Modeling</option></a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?category=Animated Graphic Design<?php if(isset($gradeDivision)){echo '&grade='.$gradeDivision;} ?>">Animated Graphic Design</option></a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?category=Case Modification<?php if(isset($gradeDivision)){echo '&grade='.$gradeDivision;} ?>">Case Modification</option></a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?category=Digital Audio Production<?php if(isset($gradeDivision)){echo '&grade='.$gradeDivision;} ?>">Digital Audio Production</option></a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?category=Digital Photography<?php if(isset($gradeDivision)){echo '&grade='.$gradeDivision;} ?>">Digital Photography</option></a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?category=Digital Video Production<?php if(isset($gradeDivision)){echo '&grade='.$gradeDivision;} ?>">Digital Video Production</option></a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?category=Game Design<?php if(isset($gradeDivision)){echo '&grade='.$gradeDivision;} ?>">Game Design</option></a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?category=Hardware<?php if(isset($gradeDivision)){echo '&grade='.$gradeDivision;} ?>">Hardware</option></a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?category=Individual Programming Challenge<?php if(isset($gradeDivision)){echo '&grade='.$gradeDivision;} ?>">Individual Programming Challenge</option></a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?category=Mobile Apps<?php if(isset($gradeDivision)){echo '&grade='.$gradeDivision;} ?>">Mobile Apps</option></a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?category=Multimedia Applications<?php if(isset($gradeDivision)){echo '&grade='.$gradeDivision;} ?>">Multimedia Applications</option></a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?category=Non-Animated Graphic Design<?php if(isset($gradeDivision)){echo '&grade='.$gradeDivision;} ?>">Non-Animated Graphic Design</option></a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?category=Non-Multimedia Applications<?php if(isset($gradeDivision)){echo '&grade='.$gradeDivision;} ?>">Non-Multimedia Applications</option></a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?category=Project Programming<?php if(isset($gradeDivision)){echo '&grade='.$gradeDivision;} ?>">Project Programming</option></a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?category=Robotics<?php if(isset($gradeDivision)){echo '&grade='.$gradeDivision;} ?>">Robotics</option></a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?category=Technology Literacy Challenge<?php if(isset($gradeDivision)){echo '&grade='.$gradeDivision;} ?>">Technology Literacy Challenge</option></a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?category=Web 2.0 Internet Applications<?php if(isset($gradeDivision)){echo '&grade='.$gradeDivision;} ?>">Web 2.0 Internet Applications</option></a></li>          
                  </ul>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
			<?php
                $numPerPage=9;

				require_once (__DIR__."/../database/database.php");

                $numProjects=getNumProjects();
                $numPages=ceil($numProjects/$numPerPage);

                if(isset($_GET['page'])&&is_numeric($_GET['page'])){
                    if($_GET['page']>$numPages){
                        $page=$numPages;
                    }
                    else if($_GET['page']<1){
                        $page=1;
                    }
                    else{
                        $page=$_GET['page'];
                    }
                }
                else{
                    $page=1;
                }
                
				$projects = getProjectsBrief($numPerPage,(intval($page)-1)*$numPerPage);
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
                    <?php
                    echo '
                        <li>
                            <a href="index.php?page=';
                            if($page>1){
                                echo $page-1;
                            }
                            else{
                                echo $page;
                            }
                            echo '">&laquo;</a>
                        </li>';
                    for($i=1;$i<=$numPages;$i++){
                        echo '
                        <li ';
                        if($i==$page){
                            echo 'class="active"';
                        } 
                        echo '>
                            <a href="index.php?page='.$i.'">'.$i.'</a>
                        </li>';
                    }
                    echo '
                        <li>
                            <a href="index.php?page=';
                            if($page<$numPages){
                                echo $page+1;
                            }
                            else{
                                echo $page;
                            }
                            echo '">&raquo;</a>
                        </li>';
                    ?>
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
