<html>
<head>

</head>
<body>

<?PHP

require_once "inviteLib.php";


if(isset($_POST['email'])&&$_POST['email']!='')
{
	inviteUser($_POST['email']);
}
else
{
echo '<meta http-equiv="refresh" content="30;url=../admin.php">';
}
?>

</body>
<html>