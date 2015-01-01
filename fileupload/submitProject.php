<?php
require "../login/checklogin.php";
require "../login/config/config.php";

if(!isset($_COOKIE["upload_user"])||!isset($_COOKIE["user_code"])||!checklogin ($db_server, $db_username, $db_password, $db_database, $_COOKIE["upload_user"], $_COOKIE["user_code"])) {

  echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"></head>';
  echo '<meta http-equiv="refresh" content="0;url=../login/login.php">';
}
else{
?>
<html>
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
    <link href="../projects/css/3-col-portfolio.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="//cdn.ckeditor.com/4.4.6/standard/ckeditor.js"></script>

	<!-- blueimp Gallery styles -->
	<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
	<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
	<link rel="stylesheet" href="css/jquery.fileupload.css">
	<link rel="stylesheet" href="css/jquery.fileupload-ui.css">

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
                <a class="navbar-brand" href="../projects/index.php"><i class="glyphicon glyphicon-record"></i> Project Sphere</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <div style="float:right;">

                <?php
                echo '<button type="button" class="btn btn-primary navbar-btn" onclick="window.location.href=\'../login/logout.php\'"><i class="glyphicon glyphicon-log-out"></i> Log Out</button>';
                ?>

                </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="page-container" style="padding-left:40px;padding-right:40px;margin-bottom:60px;">
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Submit Project</h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
	<!-- Form Submission is handled by javascript function at the bottom -->
	<form id="project_form" action="submitProject_handler.php" method="post">
        <div class="form-group">
            <label for="projectName">Project Name</label>
            <input type="text" class="form-control" name="projectName" />
        </div>  
        <div class="form-group">
            <label for="team_email">Teammate Email</label>
            <input type="text" class="form-control" name="team_email" />
        </div>
        <div class="form-group">
            <label for="team_first_name">Teamate First Name</label>
            <input type="text" class="form-control" name="team_first_name" />
        </div>
        <div class="form-group">
            <label for="team_last_name">Teammate Last Name</label>
            <input type="text" class="form-control" name="team_last_name" />
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" name="category">
                <option value="3D Modeling">3D Modeling</option>
                <option value="Animated Graphic Design">Animated Graphic Design</option>
                <option value="Case Modification">Case Modification</option>
                <option value="Digital Audio Production">Digital Audio Production</option>
                <option value="Digital Photography">Digital Photography</option>
                <option value="Digital Video Production">Digital Video Production</option>
                <option value="Game Design">Game Design</option>
                <option value="Hardware">Hardware</option>
                <option value="Individual Programming Challenge">Individual Programming Challenge</option>
                <option value="Mobile Apps">Mobile Apps</option>
                <option value="Multimedia Applications">Multimedia Applications</option>
                <option value="Non-Animated Graphic Design">Non-Animated Graphic Design</option>
                <option value="Non-Multimedia Applications">Non-Multimedia Applications</option>
                <option value="Project Programming">Project Programming</option>
                <option value="Robotics">Robotics</option>
                <option value="Technology Literacy Challenge">Technology Literacy Challenge</option>
                <option value="Web 2.0 Internet Applications">Web 2.0 Internet Applications</option>
            </select>
        </div>
        <div class="form-group">
            <label for="grade">Grade</label>
            <input type="text" class="form-control" name="grade" />
        </div>
        <div class="form-group">
            <label for="school">School</label>
            <input type="text" class="form-control" name="school" />
        </div>
        <div class="form-group">
            <label for="competition">Competition</label>
            <input type="text" class="form-control" name="competition" />
        </div>
        <div class="form-group">
            <label for="video_link">Video Link</label>
            <input type="text" class="form-control" name="video_link" />
        </div>
        <div class="form-group">
            <label for="website_link">Website Link</label>
            <input type="text" class="form-control" name="website_link" />
        </div>
    		


        <div class="form-group">
            <label for="name">Project Description</label>
            <textarea class="form-control" name="description" rows="15" placeholder="What did you create?"></textarea>
        </div>
        <div class="form-group">
            <label for="sources">Sources</label>
            <textarea class="form-control" name="sources" rows="8" placeholder="What sources did you use?"></textarea>
        </div>

    	<input type="hidden" name="photos" id="imageinput"></input>
    	
	</form>
	
	
	<form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
        <label>Upload images</label>
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" accept="image/*" multiple>
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel upload</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>
<!-- The blueimp Gallery widget -->
<div id="test-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<br />
<input type="submit" form="project_form" class="btn btn-default"></input>

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
    </div>
    <!-- /.container -->

    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
	
	
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->
<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="js/submitproject.js"></script>
	
<script>
	//Form submit action
	var frm = $('#project_form');
    frm.submit(function (ev) {
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                if (data[0]==1) {
					alert("Project Submitted");
					document.location.href = "../projects/project.php?id=" + data[1];
				} else {
					alert(data[1]);
				}
				//} else {
				//	alert ("Project Submitted Successfully");
					
				//}
				
            }
        });

        ev.preventDefault();
    });
</script>
</body>
</html>
<?php
}

?>