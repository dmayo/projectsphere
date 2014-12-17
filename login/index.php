<?php
require "checklogin.php";
require "config/config.php";

if(!isset($_COOKIE["upload_user"])||!isset($_COOKIE["user_code"])||checklogin ($db_server, $db_username, $db_password, $db_database, $_COOKIE["upload_user"], $_COOKIE["user_code"])==false) {
    echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"></head>';
	echo '<meta http-equiv="refresh" content="0;url=login.php">';
}
else{
	echo 'Hi '+$_COOKIE["upload_user"];
	echo "it works";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Introductory Electricity</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.css" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="container">
      
      <div class="hero-unit" style="background-image: url('../img/MIT_Dome_2_smaller.jpg');color:white;">
        <h1><a href="index.html" style="color:white;text-decoration:none;text-shadow: 1px 1px #000000;">Introductory Electricity</a></h1>
        <br />
        <br />
     </div>
      <div class="navbar">
        <div class="navbar-inner">
          <div class="container">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="calendar.html">Calendar</a></li>
              <li><a href="projects.html">Projects</a></li>
              <li><a href="contact.html">Contact</a></li>
              <li><a href="https://esp.mit.edu/learn/HSSP/index.html" target="_blank">About HSSP</a></li>
            </ul>
          </div>
        </div>
      </div>
    <div style="">
    <h3>Why take our class?</h3>   
    <p>
      Like the occasional book or banana, this class is good for your brain.
    </p>  
    <p>
    We will start from the very basic ideas of electric charges and conclude with fundamental applications to
    electric circuits and beyond. In between, we will study electrostatic interactions, conductors,
    insulators, and capacitors. Along the way, we will emphasize applications so that students
    can see the profound practicality of what they learn. Some of the potential applications
    that we will cover include superconductivity and semiconductors. To further enforce the
    course content, we will spend a major portion of the class getting students' hands dirty by
    constructing a Van de Graaff generator and an electrostatic motor. This way, each student
    walks away with a little demonstration of electricity and magnetism to show his or her friends.
    </p>
    <h3>Who should take this class?</h3>
    <p>
    This course is designed for the enthusiastic high school students who wish to explore exciting 
    topics in electricity and have not had formal instruction in the subject. 
    </p>
    <p>
      <i>Prerequisites:</i> We will use basic algebra and trigonometry extensively. Whatever mathematics
      used beyond algebra and trigonometry will be introduced in the course. Thus, students without
      prior exposure to the more advanced mathematics will not be at a disadvantage. Students
      should also be familiar with basic concepts of forces (Newton's laws) and energy.
    </p>
    <hr>
    <h3>Meet the Instructors</h3>
      <div class="row" >
      <div class="span4">
              <h4 class="text-center">Christian Cardozo</h4>
              <div class="row text-center">
                  <img src="img/christian_cardozo.jpg" class="img-circle" width="200" height="200" style="border: 2px solid gray;">
              </div>
              <p>
                  I am a second-year electrical engineering, computer science,
                  and physics student at MIT. My primary areas of interest in physics are electricity and magnetism, 
                  which weave themselves into my studies in electrical engineering, and cosmology, on
                  which I produced <a href="http://www.youtube.com/watch?v=7Ao6PKQeRjg" savefrom_lm_index="0" savefrom_lm="1">"Cosmology for the Science Enthusiast"</a>, a ten minute video introduction to
                  the universe that went on to be well-received by members of the MIT community at a campus-wide screening. Having taught for past MIT ESP programs like HSSP, I can undoubtedly say I am very excited to working with you all this summer, enlightening you about electricity and its inextricable ties to the world of today.
              </p>
          </div>
          <div class="span4">
              <h4 class="text-center">David Mayo</h4>
              <div class="row text-center">
                  <img src="img/david_mayo_smaller.jpg" class="img-circle" width="200" height="200" style="border: 2px solid gray;">
              </div>
              <p>Of the three teachers I am clearly the most awesome. I also look a lot like Phong.</p>
              <br />
              <br />
              <br />
              <br />
              <br />
              <br />
              <br />
              <br />
              <br />
          </div>
          <div class="span4">
              <h4 class="text-center"><a href="http://web.mit.edu/vophong/www/" style="color:black;text-decoration:none;">Phong Vo</a></h4>
              <div class="row text-center">
                 <a href="http://web.mit.edu/vophong/www/"><img src="img/phong_vo.png" class="img-circle" width="200" height="200" style="border: 2px solid gray;"></a>
              </div>
              <p>
                I am a third-year undergraduate Physics major at MIT. My current
                research interest is in solid-state physics experiments and theory. I am also fascinated by
                certain aspects of particle & nuclear physics and cosmology. In addition to my research and
                schoolwork, I also dedicate much of time sharing what I know with others through teaching.
                As such, I look forward to discovering electricity with you over the next two months.
              </p>
              <br />
              <br />
          </div>
      </div>
    </div>
      <hr>
      <div class="footer">
       <p>&copy; 2014 All course materials and content were authored by Christian Cardozo, David Mayo, and Phong Vo</p>
      </div>
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="../js/bootstrap.js"></script>
    </div>
  </body>
</html>

<?php
}

?>